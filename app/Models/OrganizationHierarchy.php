<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
/**
 * @property mixed $belongs_to_id
 * @property mixed $name_short
 * @property int|mixed $type_id
 * @property mixed $name_tibetan
 * @property mixed $name_english
 * @property mixed $id
 * @method select(string $string, string $string1, string $string2, string $string3)
 * @method where(string $string, string $string1)
 */
class OrganizationHierarchy extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'organization_hierarchies';

    protected $fillable = [
        'name_short',
        'name',
        'type_id',
        'belongs_to_id',
        'incoming_register',
        'outgoing_register',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class,'type_id','id');
    }

    public function parent(): BelongsTo
    {
    return $this->belongsTo(OrganizationHierarchy::class,'belongs_to_id','id');
    }

    public function recipients():HasMany
    {
        return $this->hasMany(Recipient::class,'organization_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'organization_id');
    }

    public function folder()
    {
        return $this->hasMany(folder::class, 'organization_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(OrganizationHierarchy::class,'belongs_to_id','id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'works_at','id');
    }


    /* Adding regsiter to organization */
    public function registers()
    {
        return $this->hasMany(Register::class,'organization_id');
    }

    public function scopeRegister($fy)
    {
        return $this->registers()->firstOrCreate(['fiscal_year'=>$fy]);
    }
    /*****************************************************/


    public function getReceptionist($org_id)
    {
        return User::role('front desk')->where('works_at',$org_id)->firstOr(function () {
            return null;
        });
    }

    public function isRoot(): bool
    {
        return $this->belongs_to_id == null;
    }

    public function getRoot()
    {
        $root = $this;
        while(!$root->isRoot())
        {
            $root = $root->parent;
        }
        return $root;
    }

    //returns collection of all users that works in this organization and all the child organizations
    public function allUsers(): Collection
    {
        $allUsers = $this->users()->get();
        $stack = $this->children()->get();
        while($stack->count())
        {
            $curOrg = $stack->pop();

            foreach($curOrg->users()->get() as $usr)
            {
                $allUsers->push($usr);
            }
            foreach($curOrg->children()->get() as $child)
            {
                $stack->push($child);
            }

        }
        return $allUsers;
    }

    public function allRecipients(): Collection
    {
        $allRecipients = $this->recipients;

        $stack = $this->children()->get();
        while($stack->count())
        {
            $curOrg = $stack->pop();

            foreach($curOrg->recipients as $recipient)
            {
                $allRecipients->push($recipient);
            }
            foreach($curOrg->children as $child)
            {
                $stack->push($child);
            }

        }
        return $allRecipients;
    }

    public function allMessages(): Collection
    {
        $allMessages = $this->messages;

        $stack = $this->children()->get();
        while($stack->count())
        {
            $curOrg = $stack->pop();

            foreach($curOrg->messages as $msg)
            {
                $allMessages->push($msg);
            }
            foreach($curOrg->children as $child)
            {
                $stack->push($child);
            }

        }
        return $allMessages;
    }

    public function allFolders(): Collection
    {
        $allFolders = $this->folder;

        $stack = $this->children()->get();
        while($stack->count())
        {
            $curOrg = $stack->pop();

            foreach($curOrg->folder as $f)
            {
                $allFolders->push($f);
            }
            foreach($curOrg->children as $child)
            {
                $stack->push($child);
            }

        }
        return $allFolders;
    }

    //returns collection of all child organizations
    public function allChildren(): \Illuminate\Support\Collection
    {

        /*$allChildren = collect();
        $allChildren = collect();
        $stack = $this->children;
        while($stack->count())
        {
            $curOrg = $stack->pop();
            $allChildren->push($curOrg);
            foreach($curOrg->children()->get() as $child)
            {
                $stack->push($child);
            }
        }
        //dd($allChildren);
        return $allChildren;*/

        $orgs = $this->children()->withCount('children')->get();
		foreach($orgs as $org)
        {
            if($org->children_count)
			{
				$suborgs = $org->allChildren();
                $orgs = $orgs->merge($suborgs);
            }

        }
        return $orgs;

    }

    public function scopeIndividual()
    {
        return $this->where('name_short','individual')->first();
    }

    public function scopeOutgoingRegisterValue()
    {
        $org = $this->getRoot();
        return $org->outgoing_register ?? 0;
    }

    public function scopeIncomingRegisterValue()
    {
        $org = $this->getRoot();
        return $org->incoming_register ?? 0;
    }

    public function getOrgChart()
    {
        $tree = $this->select('id','name_short','name')
            ->where('id',$this->id)
            ->first();
        $this->traverseOrgTree($tree, $tree);

        return json_encode([$tree]);

    }

    public static function getAllOrgCharts()
    {
        $roots = (new OrganizationHierarchy)->where('belongs_to_id',null)->get();
        $orgs = array();
        foreach($roots as $root){
            $org = $root->getOrgChart();
            $orgs[] = json_decode($org)[0];
        }
        return json_encode($orgs);
    }

    private function traverseOrgTree(&$tree, $current){
        if ($current == null)
            return;
        $children = $current->children()->select('id','name_short','name')->get();
        $current['children'] = $children;
        foreach($children as $current){
            $this->traverseOrgTree($tree, $current);
        }
    }

    public function scopefullOrganization()
    {
        $root = auth()->user()->organization->getRoot();
        $orgs = $root->allChildren();
        $orgs[] = $root;

        return $orgs;
    }

    public function scopeGetOrgTree()
    {
        $org = OrganizationHierarchy::where('id',auth()->user()->works_at)
            ->select('id','name_short as label')
            ->withCount('children')
            ->first();

        if($org->children_count)
        {
            $org['children'] = $org->traverseOrgsTree();
        }

        return $org;
    }

    private function traverseOrgsTree()
    {
        $suborgs = $this->children()
            ->select('id','name_short as label')
            ->withCount('children')
            ->get();

        foreach($suborgs as $org)
        {
            if($org->children_count)
            {
                $org['children'] = $org->traverseOrgsTree();
            }
        }
        return $suborgs;
    }
}
