<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
/**
 * @method static create(array $array)
 * @method static whereIn(string $string, array $orgs)
 */
class Folder extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'folders';

    protected $fillable = ['file_no','name','organization_id','date_opened','file_type','parent_id'];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(OrganizationHierarchy::class,'organization_id');
    }

    public function records(): BelongsToMany
    {
        return $this->belongsToMany(Message::class,'folder_message', 'folder_id', 'message_id')->withTimestamps();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class,'parent_id');
    }

    public function subfolders()
    {
        return $this->hasMany(Folder::class,'parent_id');
    }

    public function scopeGetRootFolder()
    {
        $folder = $this;
        while($folder->parent)
        {
            $folder = $folder->parent;
        }
        return $folder;
    }

    public function scopeLevel()
    {
        $level = 1; 
        $file = $this;
        while($file->parent)
        {
            $file = $file->parent;
            $level = $level + 1;
        }
        return $level;
    }

    public function getFolderTree($orgs)
    {
        $folders = Folder::select('id','file_no as label','name')
            ->with('subfolders')
            ->withCount('subfolders')
            ->whereIn('organization_id',$orgs)
            ->whereNull('parent_id')
            ->get();

        foreach($folders as $folder)
        {
            $folder->label = $folder->label.'. '.$folder->name; //Showing file no with file name 
            if($folder->subfolders_count)
            {
                $folder['children'] = $folder->traverseFolderTree();
            }
        }

        return $folders;
    }

    private function traverseFolderTree()
    {   
        $subfolders = $this->subfolders()
            ->select('id','file_no as label','name')
            ->with('subfolders')
            ->withCount('subfolders')
            ->get();

        foreach($subfolders as $folder)
        {
            $folder->label = $folder->label.'. '.$folder->name; //Showing file no with file name 
            if($folder->subfolders_count)
            {
                $folder['children']= $folder->traverseFolderTree();
            }
        }
        return $subfolders;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($folder) 
        { 
            $folder->records()->detach(); 
            foreach($folder->subfolders as $f)
            {
                $f->delete();
            }
        });
    }

    public static function promote($folders, $newOrgId){
        foreach($folders as $f)
        {
            $f->organization_id = $newOrgId;
            $f->save();
        }
    }
}
