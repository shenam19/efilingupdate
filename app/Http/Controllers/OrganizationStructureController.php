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
        abort_if(!auth()->user()->can('manage sub organizations'), 403);
        $orgs = auth()->user()->organization->getOrgChart();
        return view('organization-structure.index', ['orgs' => $orgs]);
    }

    public function edit(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'id' => 'required|exists:organization_hierarchies,id',
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:255'
        ]);
        if (!$user->can('manage sub organizations')) {
            abort(403, 'You do not have the permission to manage the sub organizations');
        }
        $editOrganization = OrganizationHierarchy::findOrFail($validated['id']);

        if ($editOrganization->getRoot()->id != $user->works_at)
        {
            abort(403, 'You can only edit organization within your jurisdiction');
        }

        $editOrganization->update([
            'name_short' => $validated['name_short'],
            'name' => $validated['name']
        ]);
        return redirect()
            ->route('organization-structure.index')
            ->with('success', 'Organization Updated');
    }

    public function add(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'id' => 'required|exists:organization_hierarchies,id',
            'name' => 'required|string|max:255',
            'name_short' => 'required|string|max:255'
        ]);
        abort_if(!$user->can('manage sub organizations'), 403, 'You are not allowed to manage sub organizations');
        $createUnderOrg = OrganizationHierarchy::findOrFail($validated['id']);

        if ($user->works_at != $createUnderOrg->getRoot()->id) {
            abort(403,'You can only add organization within your jurisdiction');
        }

        $createUnderOrg->children()->create([
            'name_short' => $validated['name_short'],
            'name' => $validated['name'],
            'belongs_to_id' => $validated['id'],
            'type_id' => 5 // Section ToDo: what if Sub Sub Sub Section
        ]);

        return redirect()
            ->route('organization-structure.index')
            ->with('success', 'Organization added succesfully');
    }

    public function destroy(Request $request)
    {
        $orgToDelete = OrganizationHierarchy::find($request->input('id'));

        $user = auth()->user();

        abort_if(!$user->can('manage sub organizations'),403, 'You are not allowed to manage the sub organizations');

        if ($orgToDelete->getRoot()->id != $user->works_at)
        {
            abort(403, 'You can only delete organization within your jurisdiction');
        }

        if ($orgToDelete->isRoot()) {
            return redirect()->route('organization-structure.index')->with('error', 'Cannot delete root office.');//warning
        }

        $parentId = $orgToDelete->parent()->first()->id;

        User::promote($orgToDelete->allUsers(), $parentId);
        Recipient::promote($orgToDelete->allRecipients(), $parentId);
        Message::promote($orgToDelete->allMessages(), $parentId);
        Folder::promote($orgToDelete->allFolders(), $parentId);

        $orgToDelete->delete();

        return redirect()->route('organization-structure.index')->with('success', 'Organization deleted.');
    }

}
