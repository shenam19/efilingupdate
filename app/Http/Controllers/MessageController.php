<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ThreadService;
use App\Http\Services\MessageService;
use App\Http\Services\RecordService;
use App\Http\Requests\MessageRequest;
use App\Models\MessageType;
use Illuminate\Validation\Rule;
use App\Models\Folder;

class MessageController extends Controller
{
    protected $threadservice;
    protected $messageservice;
    protected $recordservice;

    public function __construct(ThreadService $thread, MessageService $message, RecordService $record)
    {
        $this->threadservice    = $thread;
        $this->messageservice   = $message;
        $this->recordservice   = $record;
    }

    //Shows all the inbox UI
    public function inbox()
    {
        return view('mail.inbox');
    }

    //Shows compose message form view
    public function compose()
    {
        //Gets front desk of root organizations
        $frontDesks = User::getFrontDesk()->get();

        //Customizing the label to display
        $frontDesks->each(function ($front) {
            $front->label = $front->label . ' ( ' . $front->organization->name_short . ' )';
            $front->is_colleague = false;
        });

        $myOrg = auth()->user()->organization->fullOrganization()->pluck('id')->toArray();

        //Get colleagues
        $colleagues = User::with('organization:id,name_short')
            ->select('id', 'name as label', 'works_at')
            ->whereIn('works_at', $myOrg)->where('id', '!=', auth()->id())
            ->get();

        //Customizing the label of colleagues to display
        $colleagues->each(function ($colleague) {
            $colleague->label = '* ' . $colleague->label . ' ( ' . $colleague->organization->name_short . ' )';
            $colleague->is_colleague = true;
        });
        //Merge front-desk and colleagues
        $recipients = $frontDesks->merge($colleagues);

        //Get the outgoing no
        $fy = fiscalYear();
        $register = auth()->user()->organization->getRoot()->registers()->firstOrCreate(
            ['fiscal_year' => $fy],
            ['incoming_no' => 0, 'outgoing_no' => 0]
        );
        $outgoing_no = $register->outgoing_no + 1;

        $messageTypes = MessageType::select('id', 'name_tibetan as label')->get();

        $fileTree = auth()->user()->hasRole(['front desk', 'admin'])
            ? (new Folder())->getFolderTree($myOrg)
            : (new Folder())->getFolderTree(array(auth()->user()->works_at));

        return view('mail.compose', compact('recipients', 'outgoing_no', 'messageTypes', 'fileTree', 'myOrg'));
    }

    //Shows more details about this message
    public function show(Message $message)
    {
        abort_if(!$message->hasAccess(), 403);
        $message->markAsRead(auth()->id());

        return view('mail.show', compact('message'));
    }

    public function showDraft(Message $message)
    {
        abort_if(!$message->hasAccess(), 403);
        abort_if($message->status != 'draft', 403);

        //Gets front desk of root organizations
        $frontDesks = User::getFrontDesk()->get();

        //Customizing the label to display
        $frontDesks->each(function ($front) {
            $front->label = $front->label . ' ( ' . $front->organization->name_short . ' )';
            $front->is_colleague = false;
        });

        $myOrg = auth()->user()->organization->fullOrganization()->pluck('id')->toArray();

        //Get colleagues
        $colleagues = User::with('organization:id,name_short')
            ->select('id', 'name as label', 'works_at')
            ->whereIn('works_at', $myOrg)->where('id', '!=', auth()->id())
            ->get();

        //Customizing the label of colleagues to display
        $colleagues->each(function ($colleague) {
            $colleague->label = '* ' . $colleague->label . ' ( ' . $colleague->organization->name_short . ' )';
            $colleague->is_colleague = true;
        });
        //Merge front-desk and colleagues
        $recipients = $frontDesks->merge($colleagues);

        $letterNumber = '';

        $letterNumber = $message->record->outgoing_word ?? '';
        //Get the outgoing no
        $fy = fiscalYear();
        $register = auth()->user()->organization->getRoot()->registers()->firstOrCreate(
            ['fiscal_year' => $fy],
            ['incoming_no' => 0, 'outgoing_no' => 0]
        );
        $outgoing_no = $register->outgoing_no + 1;

        $orgs = auth()->user()->hasRole(['admin', 'front desk'])
            ?   array_merge(array(auth()->user()->works_at), auth()->user()->organization->allChildren()->pluck('id')->toArray())
            :   array(auth()->user()->works_at);

        $fileTree = (new Folder())->getFolderTree($myOrg);

        $messageTypes = MessageType::select('id', 'name_tibetan as label')->get();

        return view('mail.draft.show', compact('message', 'recipients', 'outgoing_no', 'messageTypes', 'letterNumber', 'fileTree'));
    }

    //Shows all the message in a thread
    public function sent()
    {
        return view('mail.sent');
    }

    public function draft()
    {
        return view('mail.draft.index');
    }

    //Sends the message or saves a draft
    public function send(MessageRequest $request)
    {
        $request->validate([
            "recipients"            => ['required'],
            "message_type_id"       => ['required', 'numeric'],
            "subject"               => ['required', 'max:2048'],
            "record.outgoing_no"    => ['required', 'numeric', 'min:1'],
            "remarks"               => ['max:65535'],
            "status"                => ['required', Rule::in(['sent', 'draft'])]
        ]);

        $data      = $request->all();

        $message   = $this->messageservice->create($data, 'outgoing'); //message services to create message

        $this->recordservice->create($message, $data['record'], 'outgoing'); //record services to create record

        return redirect()->route($data['status'])
            ->with('success', $data['status'] == 'sent' ? 'Message sent successfully.' : 'Message saved in draft successfully.');
    }

    //Sends the draft message
    public function sendDraft(MessageRequest $request, Message $message)
    {

        $request->validate([
            "recipients"            => ['required'],
            "message_type_id"       => ['required', 'numeric'],
            "subject"               => ['required', 'max:2048'],
            "record.outgoing_no"    => ['required', 'numeric', 'min:1'],
            "remarks"               => ['max:65535'],
            "status"                => ['required', Rule::in(['sent', 'draft'])]
        ]);

        abort_if($message->user_id != auth()->id(), 403);

        $data = $request->all();

        $message = $this->messageservice->update($message, $data, 'outgoing');
        $this->recordservice->update($message, $data['record'], 'outgoing');

        return redirect()->route($data['status'])
            ->with('success', $data['status'] == 'sent' ? 'Message sent successfully.' : 'Message saved in draft successfully.');
    }

    //Reply function
    public function reply(Request $request, Message $message)
    {

        $data = $request->all();

        if ($message->user_id != auth()->id()) {
            $data['recipients'] = $message->user_id;
        } else {
            $recs = array();
            foreach ($message->recipients as $recipient)
                array_push($recs, $recipient->user->id);
            $data['recipients'] = $recs;
        }

        $m = $this->messageservice->create($message->thread->id, $data, 'outgoing');

        return redirect()->route('inbox')->with('success', 'Reply sent successfully.');
    }
}
