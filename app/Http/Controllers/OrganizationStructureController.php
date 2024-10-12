<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Recipient;
use Illuminate\Http\Request;
use App\Models\OrganizationHierarchy;
use App\Models\User;
use App\Models\Folder;

use Illuminate\Support\Facades\DB;

class OrganizationStructureController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('manage sub organizations'),403);
        $orgs = auth()->user()->organization->getOrgChart();        
        return view('organization-structure.index',['orgs'=>$orgs]);
    }
    public function edit(Request $request){
        abort_if(!auth()->user()->can('manage sub organizations'),403);
        $update = $request->all();

        DB::table('organization_hierarchies')
        ->where('id', (int) $update['id'])
        ->update(['name_short' => $update['name_short'],
                'name' => $update['name'],                
            ]);
        return redirect()->route('organization-structure.index')->with('success', 'Organization updated.');
    }
    public function add(Request $request){
        abort_if(!auth()->user()->can('manage sub organizations'),403);
        $update = $request->all();
        //Create Child
        $childOrg = new OrganizationHierarchy;
        $childOrg->name_short = $request->input('name_short');
        $childOrg->name = $request->input('name');        
        $childOrg->belongs_to_id = (int)$request->input('id');
        $childOrg->type_id = 5; // Section ToDo: what if Sub Sub Sub Section
        $childOrg->save();

        return redirect()->route('organization-structure.index')->with('success', 'Organization Added.');
    }

    public function destroy(Request $request){
        abort_if(!auth()->user()->can('manage sub organizations'),403);
        $orgToDelete = OrganizationHierarchy::find($request->input('id'));
        // independent root organizations can not be deleted
        if($orgToDelete->isRoot()){
            return redirect()->route('organization-structure.index')->with('error', 'Cannot delete root office.');//warning
        }        
        //clicked organization's parent org id
        $parentId = $orgToDelete->parent()->first()->id;
        
        //all [ users | recipients | messages | folder ] that is attached to orgs in this sub tree will be promoted to parent org on delete        
        User::promote($orgToDelete->allUsers(), $parentId);
        Recipient::promote($orgToDelete->allRecipients(), $parentId);
        Message::promote($orgToDelete->allMessages(), $parentId);
        Folder::promote($orgToDelete->allFolders(), $parentId);
        
        $orgToDelete->delete();
        return redirect()->route('organization-structure.index')->with('success', 'Organization deleted.');
    }

}
