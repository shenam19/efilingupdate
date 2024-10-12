<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactsTree = Contact::getContactTree();        
        return view('contact.index',['contactsTree'=>$contactsTree]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([                        
            'name'  => ['required', 'string', 'max:125'],
            'email' => ['email','max:125','nullable'],        
            'phone' => ['max:15'],
            'parent_id' => ['exists:contacts,id',],
            'address' => ['max:200']
        ]);                        
        $validated['org_id'] = auth()->user()->organization->getRoot()->id;     
        $newContact = Contact::create($validated);
        return redirect()->route('contact.index')->with('success', 'new contact created');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {                
        abort_if(! ($contact->org_id == auth()->user()->organization->getRoot()->id || $contact->org_id == null),404);
        return view('contact.show',['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {               
        abort_if($contact->org_id != auth()->user()->organization->getRoot()->id,404);
        $contactsTree = Contact::getContactTree();
        return view('contact.edit', ['contact'=> $contact, 'contactsTree'=>$contactsTree]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {   
        abort_if($contact->org_id != auth()->user()->organization->getRoot()->id,404);        
        $validated = $request->validate([                        
            'name'  => ['required', 'string', 'max:125'],
            'email' => ['email','max:125','nullable'],        
            'phone' => ['max:15'],
            'parent_id' => ['exists:contacts,id',],
            'address' => ['max:200']
        ]);  

        $contact->name = $validated['name'];
        $contact->email = $validated['email'];
        $contact->phone = $validated['phone'];
        if($validated['parent_id'] ?? null){
            // if this parent_id creates a loop, don't update
            if(! $contact->isLoop($validated['parent_id'])){
                $contact->parent_id = $validated['parent_id'];
            }        
        }
        $contact->address = $validated['address'];
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'contact updated');                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, Request $request)
    {           
        abort_if($contact->org_id != auth()->user()->organization->getRoot()->id,404);  
        
        if($contact->message->count() > 0 || $contact->recipient->count() > 0){            
            $validator = Validator::make($request->all(), [
                'transferContact'  => 'required|exists:contacts,id'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Contact to transfer the messages not selected.');    
            }            
            $to = $request->all()['transferContact'];
            if($to == $contact->id){                
                return redirect()->back()->with('error', 'Transfer to same contact error.');    
            }
            foreach($contact->message as $m){
                $m->contact_id = $to;
                $m->save();
            }
            foreach($contact->recipient as $r){
                $r->contact_id = $to;
                $r->save();
            }                                    
        }
        foreach( $contact->subcontacts as $sc){
            $sc->parent_id = $contact->parent?->id;
            $sc->save();
        }
        $contact->delete();        
        return redirect()->back()->with('success', 'Contact deleted.');    
    }    
}
