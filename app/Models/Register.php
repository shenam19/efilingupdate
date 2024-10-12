<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id','fiscal_year','incoming_no','outgoing_no'];

    public function organization()
    {
        return $this->hasMany(OrganizationHierarchy::class);
    }
}
