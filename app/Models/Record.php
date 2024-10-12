<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Record extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['message_id','outgoing_no','outgoing_word','dispatched_date','received_date','fiscal_year','mode','language'];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }    
}
