<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

class PullBack extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['new_message_id', 'reason'];
    public function oldMessage(): HasOne
    {
        return $this->hasOne(Message::class,'pull_back_id');
    }
    public function newMessage()
    {
        return $this->belongsTo(Message::class,'new_message_id');
    }
}
