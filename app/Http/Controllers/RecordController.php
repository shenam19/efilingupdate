<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Thread;
use App\Models\Participant;
use Illuminate\Support\Str;
use App\Http\Services\ThreadService;
use App\Http\Services\MessageService;
use App\Http\Services\RecordService;
use App\Models\OrganizationType as OrgType;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\MessageRequest;
use App\Models\MessageType;
use App\Models\Folder;
use App\Models\OrganizationHierarchy;
use Carbon\Carbon;

class RecordController extends Controller
{
    protected $threadservice;
    protected $messageservice;

    public function __construct(ThreadService $thread, MessageService $message, RecordService $record)
    {
        $this->threadservice    = $thread;
        $this->messageservice   = $message;
        $this->recordservice    = $record;
    }

    public function index($type)
    {
        return view('record.index', compact('type'));
    }

    public function create($type)
    {
        $sections = auth()->user()->organization->fullOrganization()->pluck('id')->toArray();

        /*Gets only user which are staff of an organization
        $users = User::whereHas('organization', function (Builder $query) {
                $type = OrgType::whereIn('name_short',['external','individual'])->pluck('id')->toArray();
                $query->whereIn('type_id',$type);
            })->get();x
        */

        //Gets front desk of root organizations
        $frontDesks = User::getFrontDesk()->get();

        //Customizing the label to display
        $frontDesks->each(function ($front) {
            $front->label = $front->label . ' ( ' . $front->organization->name_short . ' )';
            $front->is_colleague = false;
        });

        $fy = fiscalYear();
        $register = $type === 'incoming'
            ?  auth()->user()->organization->getRoot()->registers()->firstOrCreate(
                ['fiscal_year' => $fy],
                ['incoming_no' => 0, 'outgoing_no' => 0]
            )->incoming_no + 1
            : auth()->user()->organization->getRoot()->registers()->firstOrCreate(
                ['fiscal_year' => $fy],
                ['incoming_no' => 0, 'outgoing_no' => 0]
            )->outgoing_no + 1;

        $messageTypes = MessageType::get();

        //$orgs = array_merge(array(auth()->user()->works_at),$sections->pluck('id')->toArray());

        $orgChart = auth()->user()->organization->getOrgChart();
        $orgChart = str_replace('name_short', 'label', $orgChart);

        $fileTree = auth()->user()->hasRole(['front desk', 'admin'])
            ? (new Folder())->getFolderTree($sections)
            : (new Folder())->getFolderTree(array(auth()->user()->works_at));

        return view('record.create', compact('frontDesks', 'type', 'sections', 'register', 'messageTypes', 'orgChart', 'fileTree'));
    }

    public function store(MessageRequest $request, $type)
    {

        //Validation
        $type === 'outgoing'
            ? $request->validate(['record.dispatched_date' => ['required', 'date'], 'record.outgoing_no' => ['numeric', 'min:1']])
            : $request->validate(['record.received_date' => ['required', 'date'],  'record.incoming_no' => ['numeric', 'min:1']]);

        $data = $request->all();
        //Create message
        $message = $this->messageservice->create($data, $type, true);

        //Stores metadata for the message created
        $this->recordservice->create($message, $data['record'], $type, true);

        return redirect()->route('record', $type)->with('success', ucfirst($type) . ' record registered successfully');
    }

    public function show($type, Message $message)
    {
        $myOrgs   = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();

        return view('record.show', compact('type', 'message', 'myOrgs'));
    }

    public function edit($type, Message $message)
    {
        $myOrgs   = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
        abort_if(! $message->isEditable($myOrgs), 404);
        $sections = auth()->user()->organization->allChildren();

        $messageTypes = MessageType::get();

        $orgs = auth()->user()->hasRole(['admin', 'front desk'])
            ?   array_merge(array(auth()->user()->works_at), auth()->user()->organization->allChildren()->pluck('id')->toArray())
            :   array(auth()->user()->works_at);

        $orgChart = auth()->user()->organization->getOrgChart();
        $orgChart = str_replace('name_short', 'label', $orgChart);

        $fileTree = auth()->user()->hasRole(['front desk', 'admin'])
            ? (new Folder())->getFolderTree($orgs)
            : (new Folder())->getFolderTree(array(auth()->user()->works_at));

        //Gets front desk of root organizations
        $frontDesks = User::getFrontDesk()->get();

        //Customizing the label to display
        $frontDesks->each(function ($front) {
            $front->label = $front->label . ' ( ' . $front->organization->name_short . ' )';
            $front->is_colleague = false;
        });

        // return view('record.edit',compact('type','sections','register','messageTypes','folders','orgChart','fileTree'));
        return view('record.edit', compact('frontDesks', 'message', 'type', 'sections', 'messageTypes', 'orgChart', 'fileTree', 'myOrgs'));
    }

    public function update(MessageRequest $request, $type, Message $message)
    {
        $myOrgs   = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
        abort_if(! $message->isEditable($myOrgs), 404);
        $type === 'outgoing'
            ? $request->validate(['record.dispatched_date' => ['required', 'date'], 'record.outgoing_no' => ['numeric', 'min:1']])
            : $request->validate(['record.received_date' => ['required', 'date'],  'record.incoming_no' => ['numeric', 'min:1']]);

        $data = $request->all();

        //Update message
        $message = $this->messageservice->update($message, $data, $type, true);

        //Stores metadata for the message created

        $this->recordservice->update($message, $data['record'], $type, true);

        return redirect()->route('record', compact('type'))->with('success', ucfirst($type) . ' record updated successfully');
    }

    public function print($type, Request $request)
    {
        $myOrgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();

        $from   = $request->input('printDate1') ? Carbon::parse($request->input('printDate1')) : Carbon::today();
        // $to     = $request->input('printDate2') ? Carbon::parse($request->input('printDate2'))->addHours('21') : Carbon::today()->addHours('21');
        $to     = $request->input('printDate2') ? Carbon::parse($request->input('printDate2'))->addHours(21) : Carbon::today()->addHours(21);

        $msgQuery = $type === 'incoming'
            ? Message::where(function ($query) use ($myOrgs) {
                $query->whereNotIn('messages.organization_id', $myOrgs)
                    ->orWhereNull('messages.user_id');
            })
            : Message::whereIn('organization_id', $myOrgs)
            ->where('status', '=', 'sent');

        $messages =  $msgQuery->where('status', 'sent')
            ->with('sender', 'contactSender', 'recipients')
            ->whereHas('record', function ($query) use ($type, $from, $to) {
                $query->whereBetween($type === 'outgoing' ? 'dispatched_date' : 'received_date', [$from, $to]);
            })
            ->has('record')
            ->when($type === 'incoming', function ($query) use ($myOrgs) {
                $query->join('recipients', 'messages.id', '=', 'recipients.message_id')
                    ->whereIn('recipients.organization_id', $myOrgs)
                    ->orderBy('recipients.incoming_no');
            }, function ($query) {
                $query->leftJoin('records', 'records.message_id', '=', 'messages.id')
                    ->orderBy('records.outgoing_no', 'asc');
            })
            ->get(['messages.*']);

        return view('record.print', compact('messages', 'type', 'myOrgs'));
    }
}
