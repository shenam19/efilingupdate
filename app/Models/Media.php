<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @property mixed $messages
 * @property mixed $user
 * @method static where(string $string, $name_short)
 */
class Media extends BaseMedia implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    public function messages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class,'attachments', 'media_id','message_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'model_id')->withTrashed();
    }

    public function scopeHasAccess(): bool
    {        
        //dd(auth()->user()->organization->getRoot()->id,$this->user->organization->getRoot()->id);
        if(auth()->id() === $this->model_id || (auth()->user()->organization->getRoot()->id === $this->user->organization->getRoot()->id && auth()->user()->hasRole(['admin','front desk'])))
        {
            return true;
        }
        
        foreach($this->messages as $message)
        {            
            $hasAccess = $message->hasAccess();
            if($hasAccess)
            {
                return true;
            }                           
        }

        return false;
        
    }
}
