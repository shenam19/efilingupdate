<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $participants
 * @property mixed $messages
 * @method whereRelation(string $string, string $string1, int|string|null $userId)
 */
class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['subject'];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'thread_id', 'id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'thread_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Models::classname('User'), Models::table('participants'), 'thread_id', 'user_id');
    }

    //Gets the message which forwards this thread
    public function forwarded(): HasMany
    {
        return $this->hasMany(Message::class,'forward_id');
    }

    public function getAllParticipants()
    {
        return $this->participants->where('user_id','!=',auth()->id())->get();
    }

    //Return threads that the user is participant in.
    public function scopeForUser()
    {
        $userId = auth()->id();

        return $this->whereRelation('participants','user_id',$userId)
            ->whereRelation('messages','user_id','!=',$userId);
    }

    //Return threads that the user has sent out
    public function scopeSentByUser()
    {
        $userId = auth()->id();

        return $this->whereRelation('participants','user_id',$userId)
            ->whereRelation('messages','user_id',$userId);
    }

    //Returns the latest message from a threads
    public function getLatestMessageAttribute()
    {
        return $this->messages()->latest()->first();
    }

    //Returns the latest message from a thread which is not written by the logged-in user.
    public function getLatestMessageAttributeForUser()
    {
        return $this->messages()->where('user_id','!=',auth()->id())->latest()->first();
    }

    //Returns the latest message from a thread which is sent by the logged-in user.
    public function getLatestMessageAttributeSentByUser()
    {
        return $this->messages()->where('user_id','=',auth()->id())->latest()->first();
    }

    //Remove participant from a thread
    public function removeParticipant($userId)
    {
        $userIds = is_array($userId) ? $userId : (array) func_get_args();

        Models::participant()->where('thread_id', $this->id)->whereIn('user_id', $userIds)->delete();
    }

    public function removeAllParticipants()
    {
        $this->participants()->delete();
    }

    //Add users to thread as participants.
    public function addParticipant($userId)
    {
        $userIds = is_array($userId) ? $userId : (array) func_get_args();

        collect($userIds)->each(function ($userId) {
            $this->participants()->firstOrCreate([
                'user_id' => $userId,
                'thread_id' => $this->id,
            ]);
        });
    }

    //Returns TRUE if the latest message in a thread is unread
    public function scopeHasUnreadMsg()
    {
        return $this->getLatestMessageAttribute()->isUnread();
    }

    // Marks all the messages in a thread as read
    public function markAsRead($userId)
    {
        try {

            $this->messages->each(function($message) use ($userId) {
                $message->markAsRead($userId);
            });
        } catch (ModelNotFoundException $e) {
            // do nothing
        }
    }

    //Returns the name of the recipients of messages in a thread (2 max)
    public function scopeSenders(): string
    {
        $name = '';
        $senders = array_unique($this->messages->pluck('user_id')->toArray());
        for($i = 0; $i < count($senders) ; $i++)
        {
            $name .= $senders[$i] == auth()->id() ? 'Me' : User::find($senders[$i])->name;
            $name .=  $i != count($senders) - 1 ? ', ' : '';
            if($i == 1)
            {
                break;
            }
        }
        return $name;
    }


}
