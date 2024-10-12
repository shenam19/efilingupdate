<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\OrganizationHierarchy;
use App\Models\MessageType;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static forOrganization()
 * @method static sharedMedia()
 * @method static where(string $string, $uuid)
 * @method static allRecords()
 * @property mixed $recipients
 * @property mixed $sender
 * @property mixed $user_id
 * @property mixed $status
 * @property mixed $created_at
 * @property mixed $thread
 * @property mixed $id
 */
class Message extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = ['thread_id','is_user', 'user_id','contact_id', 'remarks','status','organization_id','forward_id','uuid','message_type_id','subject','urgency'];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'thread_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(MessageType::class, 'message_type_id', 'id')->withDefault([
            'name_english' => 'generic',
        ]);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }

    public function contactSender(): BelongsTo
    {
        return $this->belongsTo(Contact::class,'contact_id');
    }

    public function record(): HasOne
    {
        return $this->hasOne(Record::class);
    }
    
    public function pullBack(): BelongsTo
    {
        return $this->belongsTo(PullBack::class);
    }

    public function prevPullBack(): HasOne
    {
        return $this->HasOne(PullBack::class,'new_message_id');
    }
    
    public function organization(): BelongsTo
    {
        return $this->belongsTo(OrganizationHierarchy::class,'organization_id');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class);
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Media::class,'attachments', 'message_id','media_id');
    }

    //Gets the previous older message in the forward chain.
    public function forwarded(): BelongsTo
    {
        return $this->belongsTo(Message::class,'forward_id');
    }
    //Gets the next newer message in the forward chain.
    public function forwarder(): HasMany
    {
        return $this->hasMany(Message::class,'forward_id');
    }
    
    public function folders() : BelongsToMany
    {
        return $this->belongsToMany(Folder::class)->withTimestamps();
    }

    //Get shared media from message attachments
    public function scopeSharedMedia()
    {
        $media = $this->forUser()->has('attachments')->get()->transform(function ($m)
        {
            $attachments = $m->attachments;
            //Loops through the users message to see if it has any forwarded
            while($m->forward_id)
            {                   
                $attachments = $attachments->concat($m->forwarded->attachments);

                if($m->forwarded->forward_id)
                {
                    $m =  $m->forwarded;
                }
                else{
                    break;
                }
            }
            return $attachments;
        });

        return $media->collapse()->unique("id");
    }

    public function removeAllRecipients()
    {
        $this->recipients()->delete();
    }    

    //Returns message for the authenticated user
    public function scopeForUser(Builder $query): Builder
    {
        $userId = auth()->id();
        return $query->where(function ($query) 
            {
                $query->where('user_id','!=', auth()->id())
                ->orWhereNull('user_id');
            })
            ->where('status','!=','draft')
            ->where('status','sent')
            ->whereRelation('recipients','user_id',$userId)
            ->latest('updated_at');
    }

    //Returns message received by the organization's front desk
    public function scopeForOrganization(Builder $query, $myOrgs): Builder
    {        
        return $query->where(function ($query) use($myOrgs)
            {
                $query->whereNotIn('messages.organization_id',$myOrgs)
                ->orWhereNull('messages.user_id');
            })
            ->where('status','=','sent')
            ->join('recipients', 'messages.id', '=', 'recipients.message_id')
            ->whereIn('recipients.organization_id', $myOrgs)
            ->join('records', 'messages.id', '=', 'records.message_id')
            ->orderBy('records.fiscal_year','desc')
            ->orderByDesc('recipients.incoming_no')
            ->latest();
        /* 
        return $query->where(function ($query) use($myOrgs)
            {
                $query->whereNotIn('organization_id',$myOrgs)
                ->orWhereNull('user_id');
            })
            ->where('status','=','sent')
            ->whereHas('recipients', function (Builder $query) use($myOrgs) {
                $query->whereIn('organization_id', $myOrgs);
            })
            ->latest()
            ->orderByDesc('id');
        */
    }

    //Returns message that the user has sent out
    public function scopeSentByUser(Builder $query): Builder
    {
        return $query->where('user_id','=', auth()->id())
        ->where('status','!=','draft')
        ->where('status','sent')
        ->latest();
    }

    //Returns message that the user has sent out
    public function scopeMyDraft(Builder $query): Builder
    {
        return $query->where('user_id','=', auth()->id())
        ->where('status','draft')
        ->orderBy('updated_at', 'desc');
    }

    //Returns message that the organization has sent out
    public function scopeSentByOrganization(Builder $query, $myOrgs): Builder
    {
        return $query->whereIn('organization_id', $myOrgs)
        ->where('status','=','sent')
        // ->latest()
        ->join('records', 'messages.id', '=', 'records.message_id')
        ->orderBy('records.fiscal_year','desc')
        ->orderBy('records.outgoing_no','desc');
    }

    public function scopeAllRecords(Builder $query) : Builder
    {   
        $org    = auth()->user()->organization->getRoot(); //Gets the authenticated user's org
        $orgs   = $org->allChildren()->pluck('id')->toArray(); //Gets the children of the that org
        $orgs[] = $org->id;

        return $query->whereIn('organization_id', $orgs)
            ->where('status','!=','unsent')
            ->orWhereHas('recipients', function (Builder $query) use($orgs) {
                $query->whereIn('organization_id', $orgs);
            })
            ->latest();
    }

    //Return a recipient from message
    public function getOneRecipient($userId)
    {
        return $this->recipients()->where('user_id', $userId)->firstOrFail();
    }

    //Return all recipient from message
    public function getAllRecipients()
    {
        return $this->recipients;
    }

    // Check if the user is a recipient of this message or is a recipient of any of the mssages that forwards this message
    public function hasAccess(): bool
    {   
        $hasAccess = $this->getAllRecipients()->pluck('user_id')->toArray();
        if($this->is_user)
        {
            $hasAccess[] = $this->sender->id;
        }
        
        if(in_array(auth()->id(),$hasAccess)){
            return true;
        }
	/**
         * Added a custom rule that says front desk of TCRC and admin of TCRC shares access to messages to each other.
         */
        if(auth()->user()->organization->getRoot()->id === 14 && auth()->user()->hasRole(['admin','front desk']) && (in_array(17, $hasAccess) || in_array(33, $hasAccess))){
            return true;
        }	
        foreach($this->forwarder as $message)
        {
            if($message->hasAccess())
            {
                return true;
            }
        }
        
        if(isset($this->prevPullBack)){
            if($this->prevPullBack->oldMessage->hasAccess())
            {
                return true;
            }
        }

        return false;
    }

    // Marks the message as read
    public function markAsRead($userId)
    {
        try {
            $recipient = $this->recipients()->where('user_id',$userId)->first();
            if($recipient)
            {
                $recipient->last_read = new Carbon();
                $recipient->save();
            }
           
        } catch (ModelNotFoundException $e) {
            // do nothing
        }
    }

    //Returns message which are unread by the authenticated user
    public function scopeUnreadMessages(Builder $query, $userId): Builder
    {
        return $query->whereRelation('recipients','user_id',auth()->id())->whereRelation('recipients','last_read',NULL);
    }

    //Returns true if message is unread
    public function scopeIsUnread(): bool
    {
        try {
            $recipient = $this->recipients->where('user_id',auth()->id())->first();
            if($recipient)
            {
                return is_null($recipient->last_read);
            }

        } catch (ModelNotFoundException $e) {
            // do nothing
        }
        return false;
    }

    public function canUnsent(): bool
    {

        //sent messages can be pulled back
        if($this->status !== 'sent'){
            return false;
        }

        //sender of this message can unsent
        if(!$this->is_user){
            return false;
        }

        if($this->user_id !== auth()->user()->id){
            return false;
        }

        //message older than 1 week old cannot be unsent
        if($this->created_at->diffInDays(Carbon::now()) > 7){
            return false;
        } 

        //message sent withing an office can not be unsent                    
        if(!$this->record)
        {
            return false;
        }   
      
        /* message sent to contacts can not be pulled back
        foreach($this->recipients as $k=>$v)
        {
            if(!$v->is_user){
                return false;
            }
        }*/
        return true;
//        $canUnsent = false;
//        if($this->user_id == auth()->id() && $this->status == 'sent')
//        {
//            $canUnsent = $this->recipients->where('user_id','!=',auth()->id())->pluck('last_read')->reduce(function ($carry, $item)
//            {
//                return $carry && $item == null;
//            }, true);
//        }
//        return $canUnsent;
    }

    public function scopeReplyTo()
    {
        if($this->user_id != auth()->id())
        {
            return $this->sender;
        }
        else
        {
            return $this->recipients;
        }
    }

    public function getOriginalMessage($showLatest = false)
    {
        $message = $this;
        while($message->forward_id)
        {
            $message = $message->forwarded;
        }        
        if($showLatest){
            $message = $message->getLatestCorrection();
        }        
        return $message;
    }

    public function getSenderName()
    {
        if($this->is_user)
        {
            return $this->sender->name;
        }
        else
        {
            return $this->contactSender->name;
        }
    }

    public function getSenderOrgName()
    {
        if($this->is_user)
        {            
            return $this->organization->name_short;
        }
        else
        {
            return $this->contactSender->name;
        }
    }
    
    //Returns recipients of a message
    public function getRecipientsNames($truncate = true)
    {   
        foreach($this->recipients as $recipient)
        {
            $ans = $recipient->getName();
            $ans.= $this->recipients->count() > 1 ? '+'.$this->recipients->count() - 1 : '';
            return $ans;
        }
    }

    public function getLatestCorrection()
    {
        if(!isset($this->pullBack))
        {
            return $this;
        }
        
        $ans = $this;
        while(isset($ans->pullBack)){
            $ans = $ans->pullBack->newMessage;
        }
        
        return $ans;
    }

    public function getOutgoingLetterNo()
    {           
        if (!isset($this->record)){
            return '';
        }
        $ans = $this->record->outgoing_word;
        if(isset($this->record->outgoing_word) && isset($this->record->outgoing_no)){
            $ans .= '/';
        }     
        $ans .=$this->record->outgoing_no;
        return $ans;
    }
    
    public function getIncomingNo($myOrgs = array())
    {
        $myOrgs = !empty($myOrgs) ? $myOrgs : OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
        $ans = '';        
        $ans .= $this->recipients->whereIn('organization_id',$myOrgs)->first()?->incoming_no;
        // $ans .=' '.$this?->record?->outgoing_word;
        return $ans;
        
    }

    public function getRecipientOrg($myOrgs)
    {
        return $this->recipients->whereIn('organization_id',$myOrgs)->first()->organization_id;
    }

    public function getRecipientOrgName($myOrgs)
    {
        return $this->recipients->whereIn('organization_id',$myOrgs)->first()->organization->name_short;
    }

    // TODO: simplify 
    public function isEditable($myOrgs):bool
    {           
        
        //sender is a contact | Incoming
        if(!$this->is_user){
            //Incming filled by me
            if($this->recipients->whereIn('organization_id',$myOrgs)->first()?->user_id === auth()->id()){
                return true;
            }
            //Incoming filled by someone in my org and I am the 'front desk'
            if(OrganizationHierarchy::find($this->recipients->whereIn('organization_id',$myOrgs)->first()?->organization_id) === auth()->user()->organization->getRoot() &&
            auth()->user()->getRoleNames()->contains('front desk'))
            {
                return true;
            }

        }
        //all the recipients are contacts | Outgoing
        if($this->recipients->every(function ($value, $key){
            return !$value->is_user;
            }))
        {               
            // Outgoing filled by me
            if($this->user_id === auth()->id())
            {
                return true;
            }
            // Outgoing filled by someone in my org and I am the 'front desk'
            if(OrganizationHierarchy::find($this->organization_id)->getRoot() === auth()->user()->organization->getRoot() &&
                auth()->user()->getRoleNames()->contains('front desk'))
            {
                return true;
            }            
        }
        return false;
    }

    public static function promote($messages, $newOrgId){
        foreach($messages as $msg)
        {
            $msg->organization_id = $newOrgId;
            $msg->save();
        }
    }

    public function getFolderNames(){
        
        $ans = $this->folders->map(function($item){
            return $item->file_no .' '. $item->name;
        })->toArray();
        
        return implode(', ',$ans);        
    }

}
