<?php

namespace App\Http\Services;
use App\Models\Thread;
use Carbon\Carbon;
use App\Models\OrganizationHierarchy;

class RecordService
{   
    //Create a record
    public function create($message, $record, $type, $is_record = false) : void
    {
        $recipients = $message->recipients;
        $recipientOrgs = array();
        foreach($recipients as $recipient) 
        {   
            if($recipient->is_user)
            {
                $recipientOrgs[] = $recipient->user->works_at;
            }
        }

        $makeRecord = $this->makeRecord($message, $recipientOrgs, $type) || $is_record; 

        if($makeRecord)
        {   
            //Get the register number of the org
            $register = auth()->user()->organization->getRoot()->registers()->firstOrCreate(
                ['fiscal_year'=>fiscalYear()],
                ['incoming_no'=>0, 'outgoing_no'=>0]
            );
            $outgoing_no = $record['old_outgoing_no'] ?? $register->outgoing_no + 1; 
            
            $message->record()->create([
                'dispatched_date'   => isset($record['dispatched_date']) ? Carbon::parse($record['dispatched_date']) : Carbon::now(),
                'received_date'     => isset($record['received_date']) ? Carbon::parse($record['received_date']) : Carbon::now(),
                'fiscal_year'       => fiscalYear(),
                'outgoing_word'     => $record['letter_number'] ? $record['letter_number'] : null,
                'outgoing_no'       => $outgoing_no,
                'mode'              => $record['mode'] ?? 'སྒྲིག་འཛུགས་ནང་ཁུལ།',
                'language'          => $record['language'] ?? 'བོད་ཡིག',
            ]);

            if($type === 'outgoing' && $message->status === 'sent') // could be draft
            {
                $register->increment('outgoing_no');
            } 
        }   
    }

    //update record
    public function update($message, $record, $type, $is_record = false) : void
    {
        $recipients = $message->recipients;
        $recipientOrgs = array();
        if(! $is_record)
        {
            foreach($recipients as $recipient) 
            {
                if($recipient->is_user)
                {
                    $recipientOrgs[] = $recipient->user->works_at;
                }   
            }
        }                
        $makeRecord = $is_record || $this->makeRecord($message, $recipientOrgs);   
             
        $fiscal_year = $message->record->fiscal_year ?? fiscalYear();

        if($makeRecord)
        {   
            $register = auth()->user()->organization->getRoot()->registers()->firstOrCreate(
                ['fiscal_year'=> $fiscal_year],
                ['incoming_no'=>0, 'outgoing_no'=>0]
            );

            $message->record->update([
                'dispatched_date'   => isset($record['dispatched_date']) ? Carbon::parse($record['dispatched_date']) : Carbon::now(),
                'received_date'     => isset($record['received_date']) ? Carbon::parse($record['received_date']) : Carbon::now(),
                'fiscal_year'       => $fiscal_year,
                'outgoing_word'     => $record['letter_number'] ? $record['letter_number'] : null,
                'outgoing_no'       => $record['outgoing_no'] ?? $register->outgoing_no + 1,
                'mode'              => $record['mode'] ?? 'སྒྲིག་འཛུགས་ནང་ཁུལ།',
                'language'          => $record['language'] ?? 'བོད་ཡིག།',
            ]);

            if($type === 'outgoing' && $message->status === 'sent')
            {
                //$this->updateOutgoingRegister($record['outgoing_no']);
                //Get the register number of the org
                $register->update([
                    'outgoing_no' => max($register->outgoing_no, $message->record->outgoing_no)
                ]);
            } 
        }   
    }

    //check if record should be created or not
    public function makeRecord($message, $recipientOrgs) : bool
    {   
        
        $myOrgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();      

        $outsideOrgs = array_diff($recipientOrgs, $myOrgs);

        if(!in_array($message->organization_id, $myOrgs) || count($outsideOrgs) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //updates outgoing register 
    public function updateOutgoingRegister($outgoing_no)
    {
        $org = auth()->user()->organization->getRoot();

        $org->update([
            'outgoing_register' => max($org->outgoingRegisterValue(), $outgoing_no)
        ]);
    }
}