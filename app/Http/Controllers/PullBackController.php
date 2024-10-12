<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Folder;
use App\Models\MessageType;
use App\Http\Requests\MessageRequest;
use App\Http\Services\ThreadService;
use App\Http\Services\MessageService;
use App\Http\Services\RecordService;
use Illuminate\Support\Str;
use App\Models\PullBack;

class PullBackController extends Controller
{
    //
    protected $threadservice;
    protected $messageservice;
    protected $recordservice;

    public function __construct(ThreadService $thread, MessageService $message, RecordService $record)
    {
        $this->threadservice    = $thread;
        $this->messageservice   = $message;
        $this->recordservice   = $record;
    }

    public function show(Message $message)
    {
        
        abort_if(!$message->hasAccess(),403);                
        if (!$message->canUnsent()) {
            return redirect()->route('show', $message->uuid)->with('error', 'Message cannot be pulled back');
        }

        //Gets front desk of root organizations
        $frontDesks = User::getFrontDesk()->get();

        //Customizing the label to display 
        $frontDesks->each(function ($front) {
            $front->label = $front->label.' ( '.$front->organization->name_short.' )';
            $front->isDisabled = true;
        });

        $myOrg = auth()->user()->organization->fullOrganization()->pluck('id')->toArray();
        
        //Get colleagues 
        $colleagues = User::with('organization:id,name_short')
            ->select('id','name as label','works_at')
            ->whereIn('works_at',$myOrg)->where('id','!=',auth()->id())
            ->get();

        //Customizing the label of colleagues to display 
        $colleagues->each(function ($colleague) {
            $colleague->label = '* '.$colleague->label.' ( '.$colleague->organization->name_short.' )';
            $colleague->isDisabled = true;
        });
        //Merge frontdesk and colleagues
        $recipients = $frontDesks->merge($colleagues);                     

        $orgs = auth()->user()->hasRole(['admin','front desk'])
        ?   array_merge(array(auth()->user()->works_at),auth()->user()->organization->allChildren()->pluck('id')->toArray())
        :   array(auth()->user()->works_at);

        $fileTree = auth()->user()->hasRole(['front desk','admin']) 
            ? (new Folder())->getFolderTree($myOrg)
            : (new Folder())->getFolderTree(array(auth()->user()->works_at));

        $messageTypes = MessageType::get();        

        return view('mail.pullBack.show',compact('message','recipients','messageTypes','fileTree'));
    }

    public function send(Request $request)
    {           
        $request->validate([
            "oldMessage"            => ['required'],
            "reason"                => ['required'],            
            "message_type_id"       => ['required','numeric'],
            "subject"               => ['required','max:2048'],            
            "remarks"               => ['max:65535'],            
        ]);
        
        $data      = $request->all();
        
        $oldMessage = Message::findOrFail($data['oldMessage']);

        if (!$oldMessage->canUnsent()) {
            return redirect()->route('show', $oldMessage->uuid)->with('error', 'Message cannot be pulled back');
        }
        
        $newData['message']['user_id']         = auth()->id();
        $newData['message']['organization_id'] = auth()->user()->works_at;
        $newData['message']['message_type_id'] = $data['message_type_id'] ?? null;
        $newData['message']['status']          = 'sent';
        $newData['message']['uuid']            = Str::uuid();
        $newData['message']['remarks']         = $data['remarks'];
        $newData['message']['forward_id']      = null;
        $newData['message']['subject']         = $data['subject'];
        $newData['message']['urgency']         = $data['urgency'];

        $newMessage = Message::create($newData['message']);
        
        $oldMessage->status='unsent';
        $oldMessage->save();

        $pb = PullBack::create(['new_message_id'=>$newMessage->id, 'reason' => $data['reason']]);        
        $oldMessage->pull_back_id = $pb->id;
        $oldMessage->save();

        //Remove old message from folders
        $oldMessage->folders()->each(function($folder) use($oldMessage){
            $folder->records()->detach($oldMessage->id);
        });

        //Put the new message into folder
        if(isset($data['folder'])){
            foreach($data['folder'] as $folder)
            {
                Folder::find($folder)->records()->attach($newMessage->id,['user_id'=>auth()->id()]);
            }
        }        

        $oldMessage->recipients->each(function ($recipient) use($newMessage)
        {            
            $data = [
                'is_user'           => $recipient->is_user,
                'organization_id'   => $recipient->organization_id,
                'last_read'         => null,
                'incoming_no'       => $recipient->incoming_no,
                'user_id'           => $recipient->user_id,  
                'contact_id'        => $recipient->contact_id,  
            ];

            $newMessage->recipients()->firstOrCreate($data);
        });
        
        //Turns media id into array
        $data['media'] = $data['media'] ? explode(',',$data['media']) : null;
        $newMessage->attachments()->sync($data['media']);
        $data['record']['old_outgoing_no'] = $oldMessage->record->outgoing_no;
        $this->recordservice->create($newMessage, $data['record'], $data['status'], true);
                
        return redirect()->route('sent')
            ->with('success', 'Correction message sent successfully.');        
    }
}
