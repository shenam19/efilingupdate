<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use App\Models\OrganizationHierarchy;
use Validator;

class FolderController extends Controller
{
    public function index()
    {
        $sections = OrganizationHierarchy::getOrgTree();
        $sections = json_encode([$sections]);

        $orgs = auth()->user()->hasRole(['admin', 'front desk'])
            ?   array_merge(array(auth()->user()->works_at), auth()->user()->organization->allChildren()->pluck('id')->toArray())
            :   array(auth()->user()->works_at);

        return view('folder.index', compact('sections', 'orgs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        //Validation
        $request->validate([
            'file_no'   => ['required', 'max:65535'],
            'file_name' => ['required', 'max:65535'],
            'works_at'  => ['exists:organization_hierarchies,id'],
            'type' =>      ['required', Rule::in(['general', 'subject-file'])]
        ]);

        //Create logic
        Folder::create([
            'file_no'           => $request->input('file_no'),
            'name'              => $request->input('file_name'),
            'date_opened'       => isset($request->all()['date_opened']) ? $request->input('date_opened') : Carbon::now(),
            'organization_id'   => $request->input('works_at') ?? auth()->user()->works_at,
            'file_type'         => $request->input('type'),
            'parent_id'         => $request->input('parent') ?? null,
        ]);

        return redirect()->route('folders.index')->with('success', 'Folder created successfully');
    }

    public function show(Folder $folder)
    {
        $sections = auth()->user()->organization->getOrgChart();
        $sections = str_replace('name_short', 'label', $sections);
        $orgs = array_merge(array(auth()->user()->works_at), auth()->user()->organization->allChildren()->pluck('id')->toArray());
        return view('folder.show', compact('folder', 'orgs', 'sections'));
    }

    public function update(Request $request, Folder $folder): RedirectResponse
    {
        $input = $request->all();
        //Validation
        $validator = Validator::make($input, [
            'file_no'   => ['required', 'max:65535'],
            'file_name' => ['required', 'max:65535'],
            'works_at'  => ['exists:organization_hierarchies,id'],
            'type' =>      ['required', Rule::in(['general', 'subject-file'])]
        ]);
        if ($validator->fails()) {
            return redirect()->route('folders.index')->with('error', $validator->errors());
        }

        //Create logic
        $folder->update([
            'file_no'           => $request->input('file_no'),
            'name'              => $request->input('file_name'),
            'date_opened'       => $request->input('date_opened') ? $request->input('date_opened') : Carbon::now(),
            'organization_id'   => $request->input('works_at') ? $request->input('works_at') : $folder->organization_id,
            'file_type'         => $request->input('type')
        ]);

        return redirect()->route('folders.index')->with('success', 'Folder updated successfully');
    }

    public function print($id, Request $request)
    {

        $from = $request->input('printDate1') ? Carbon::parse($request->input('printDate1')) : Carbon::today();
        $to = $request->input('printDate2') ? Carbon::parse($request->input('printDate2'))->addHours(21) : Carbon::today()->addHours(21);

        $folder = Folder::with('records')->find($id);

        $messages = $folder->records()->whereBetween('messages.created_at', [$from, $to])->get();

        $orgs = auth()->user()->hasRole(['admin', 'front desk'])
            ?   array_merge(array(auth()->user()->works_at), auth()->user()->organization->allChildren()->pluck('id')->toArray())
            :   array(auth()->user()->works_at);
        $myOrgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
        return view('folder.print', compact('messages', 'orgs', 'myOrgs'));
    }
}
