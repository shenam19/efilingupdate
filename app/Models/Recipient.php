<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
/**
 * @method static where(string $string, string $string1, $myOrg)
 */
class Recipient extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = "recipients";

    protected $fillable = ['message_id','user_id','last_read','organization_id','incoming_no','is_user','contact_id'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class,'contact_id');
    }
    public function isUnread($userId): bool
    {
        return false;
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(OrganizationHierarchy::class,'organization_id');
    }
    public function getName()
    {
        if($this->is_user)
        {
            return $this->user->name;
        }
        else
        {
            return $this->contact->name;
        }
    }
    public static function promote($recipients, $newOrgId){
        foreach($recipients as $recipient)
        {
            $recipient->organization_id = $newOrgId;
            $recipient->save();
        }
    }


}
