<?php

namespace App\Http\Services;
use App\Models\Message;
use App\Models\PullBack;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Folder;
use App\Models\OrganizationHierarchy;
use Carbon\Carbon;

class MessageService
{
    //Create a message
    public function create($data, $type, $is_record = false)
    {   

        //Get the register number of the org
        $register = auth()->user()->organization->getRoot()->registers()->firstOrCreate(
            ['fiscal_year'=>fiscalYear()],
            ['incoming_no'=>0, 'outgoing_no'=>0]
        );


        //Incoming register saved if data is registered from incoming register record
        $incoming = $data['record']['incoming_no'] ?? $register->incoming_no + 1;

        //dd($data, $type, $record);
        $data = $this->getData($data, $type, $is_record);   
    
        //dd($data['message']);
        $message = Message::create($data['message']);

        //Attaches media to the message
        $message->attachments()->sync($data['media']);

        //Adds recipients to the message
        if($is_record)
        {
            if($type === 'outgoing')
            {
                if($data['internalRecipient'])
                {
                    $this->addRecipients($message, $data['internalRecipient']);
                }
                $this->addContactRecipients($message, $data['recipients']);
            }
            else
            {
                $this->addSelfRecipient($message, $data['section'], $incoming);
            }
        }
        else{
            $this->addRecipients($message, $data['recipients']);
        }
        
        //Adds the message to a folder if folder selection is selected
        foreach($data['folder'] as $folder)
        {
            $this->addToFolder($message, $folder);
        }

        return $message;
    }
    
    public function addRecipients($message, $userId)
    {
        $userIds = is_array($userId) ? array_unique($userId) : array($userId);
        
        collect($userIds)->each(function ($userId) use($message)
        {
            $senderFullOrg      = auth()->user()->organization->fullOrganization()->pluck('id')->toArray();
            $recipientRootOrg   = User::findOrFail($userId)->organization;

            //Check if recipient is within my org
            if(in_array($recipientRootOrg->id,$senderFullOrg))
            {
                $incoming_register = null;
            }
            //update incoming register when recipient is outside my org
            elseif($message->status === 'sent')
            {
                //Get the register of the org
                $register = $recipientRootOrg->registers()->firstOrCreate(
                    ['fiscal_year'=>fiscalYear()],
                    ['incoming_no'=>0, 'outgoing_no'=>0]
                );

                $incoming_register = $register->incoming_no + 1;

                $register->increment('incoming_no');
            }

            $data = [
                'organization_id'   => User::findOrFail($userId)->works_at,
                'last_read'         => $userId === auth()->id() ? new Carbon() : null,
                'incoming_no'       => $incoming_register ?? null,
                'user_id'           => $userId,  
            ];
            $message->recipients()->firstOrCreate($data);
        });
    }

    //Adds recipients for message send to outside the network (outgoing register)
    public function addContactRecipients($message, $userIds)
    {
        foreach($userIds as $user)
        {
            $data = [
                'is_user'           => false,
                'organization_id'   => null,
                'last_read'         => null,
                'incoming_no'       => null,
                'user_id'           => null,
                'contact_id'        => $user,
            ];

            $message->recipients()->firstOrCreate($data);
        }
    }

    //Adds recipients for message recieved from outside the network (incoming register)
    public function addSelfRecipient($message, $organization, $incoming_register, $is_updating = false)
    {   
        $user = auth()->user();

        //Get the register of the org
        $register = $user->organization->getRoot()->registers()->firstOrCreate(
            ['fiscal_year'=>fiscalYear()],
            ['incoming_no'=>0, 'outgoing_no'=>0]
        );
        
        $latestIncomingNumber = $register->incoming_no;

        if(!$is_updating)
        {
             $incoming_register =  $latestIncomingNumber >= $incoming_register 
                ? $latestIncomingNumber + 1
                : $incoming_register;

            $register->increment('incoming_no');
        }
    
            $data = [
                'organization_id'   => $organization ?: $user->works_at,
                'last_read'         => new Carbon(),
                'incoming_no'       => $incoming_register,
                'user_id'           => $user->id,
                'contact_id'        => null,
            ];

        $message->recipients()->firstOrCreate($data);
    }
    

    public function addToFolder($message,$folder_id)
    {
        if(!empty($folder_id) && $message->status === 'sent')
        {
            $folder = Folder::find($folder_id);
            $folder->records()->attach($message->id,['user_id'=>auth()->id()]);
        }
    }

    public function removeAllFolders($message)
    {
        $message->folders()->sync([]);
    }

    public function getData($data, $type, $is_record)
    {   
        $organization = array_key_exists("section",$data) ? $data['section'] : auth()->user()->works_at;  //Get organization if section is entered        
        if($is_record)
        {
            if($type === 'incoming')
            {
                $newData['message']['is_user']    = false;
                $newData['message']['contact_id'] = $data['recipients'];
            }
            else
            {                   
                $newData['message']['user_id'] = auth()->id();
                $newData['message']['organization_id'] = $organization;
                $newData['internalRecipient'] = isset($data['internalRecipients']) ? $data['internalRecipients'] : null;
            }
        }
        else
        {
            if($type === 'incoming')
            {
                $newData['message']['user_id'] = $data['recipients'];//Get sender if outgoing or incoming  
                $newData['message']['organization_id'] = User::find($data['recipients'])->works_at; // is recipients set ?     
            }
            else
            {
                $newData['message']['user_id'] = auth()->id();
                $newData['message']['organization_id'] = $organization;
            }
        }
        
        $newData['message']['message_type_id'] = $data['message_type_id'] ?? null;
        $newData['message']['status']          = $data['status'] ?? 'sent';
        $newData['message']['uuid']            = Str::uuid();//uniqid();
        $newData['message']['remarks']         = $data['remarks'];
        $newData['message']['forward_id']      = $data['forward_id'] ?? null;
        $newData['message']['subject']         = $data['subject'];
        $newData['message']['urgency']         = isset($data['urgency']) ? $data['urgency'] : 'gray';

        $newData['recipients']                 = $type ==='outgoing' ? $data['recipients'] : auth()->id();
        $newData['section']                    = $organization;
        $newData['folder']                     = isset($data['folder']) ? $data['folder'] : [];
        $newData['media']                      = $data['media'] ? explode(',',$data['media']) : null;

        return $newData;
    }

    public function update(Message $message, $data, $type = 'outgoing', $is_record = false)
    {
        //Incoming register saved if data is registered from incoming register record
        $incoming = $data['record']['incoming_no'] ?? null;
        $data = $this->getData($data, $type, $is_record);

        $data['message']['uuid'] = $message->uuid;
        // Update the message
        $message->update($data['message']);


        //Attaches media to the message
        $message->attachments()->sync($data['media']);

        //Removes recipients from the message
        $message->removeAllRecipients();        
                
         //Adds recipients to the message
        if($is_record)
        {
            if($type === 'outgoing')
            {
                if($data['internalRecipient'])
                {
                    $this->addRecipients($message, $data['internalRecipient']);
                }
                $this->addContactRecipients($message, $data['recipients']);
            }
            else
            {
                $this->addSelfRecipient($message, $data['section'], $incoming, true);
            }
        }
        else{
            $this->addRecipients($message, $data['recipients']);
        }

        $this->removeAllFolders($message);

        //Adds the message to a folder if folder selection is selected
        foreach($data['folder'] as $folder)
        {
            $this->addToFolder($message, $folder);
        }

        return $message;
    }
    
}
