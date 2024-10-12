<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Contact extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'contacts';

    protected $fillable = ['name','email','address','phone','parent_id','org_id'];
        
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Contact::class,'parent_id','id');
    }
    public function subcontacts(): HasMany
    {
        return $this->hasMany(Contact::class,'parent_id','id');
    }
    public function message(): HasMany
    {
        return $this->hasMany(Message::class,'contact_id');
    }
    public function recipient(): HasMany
    {
        return $this->hasMany(Recipient::class,'contact_id');
    }
    public function scopeGetContactTree(Builder $query)
    {
        $contacts = $query->select('id','name as label','org_id','parent_id')            
            ->withCount('subcontacts')
            ->where(function ($query) {
                $query->where('org_id',auth()->user()->organization->getRoot()->id)
                    ->orWhereNull('org_id');
            }) 
            ->whereNull('parent_id')
            ->get();

        foreach($contacts as $contact)
        {
            if($contact->subcontacts_count)
            {
                $contact['children'] = $contact->traverseContactsTree();
            }
        }
   
        return $contacts;
    }   

    private function traverseContactsTree()
    {   
        $subcontacts = $this->subcontacts()
            ->select('id','name as label','org_id','parent_id')            
            ->withCount('subcontacts')
            ->get();

        foreach($subcontacts as $contact)
        {
            if($contact->subcontacts_count)
            {
                $contact['children'] = $contact->traverseContactsTree();
            }
        }

        return $subcontacts;
    }

    public function getParentContact(Builder $query)
    {
        return $query->select('id','name as label')
            ->where('org_id',auth()->user()->organization->getRoot()->id)
            ->orWhereNull('org_id');
    }

    public function isLoop($checkParent){
        $checkParent = Contact::find($checkParent);                
                
        //check if $this is directly or indirectly parent of $checkParent
        if($this->isParentOf($checkParent)){
            return true;
        }
        return false;
    }
    public function isParentOf($checkParent){
        if($this->id === $checkParent->id){
            return true;
        }        
        foreach( $this->subcontacts as $sub){
            if($sub->isParentOf($checkParent)){
                return true;
            }
        }
    }
        
}
