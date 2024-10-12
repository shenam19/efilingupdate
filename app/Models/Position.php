<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Position extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    public function users(): HasMany
    {
        return $this->hasMany(User::class,'position_id','id');
    }
}
