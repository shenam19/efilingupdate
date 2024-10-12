<div>
    
    @if($contact)
   <div class="col-lg-4">
        <div class="text-center card-box border shadow">
            <div class="member-card pt-4 pb-2">
                <div class="">
                    <h4>{{ $contact->name}}</h4>
                    <p class="text-muted ">
                        <span class="text-dark"><i class="fas fa-phone"></i> {{ $contact->phone ?? '------'}} </span>
                        <span>| </span>
                        <span class="text-primary"><i class="fas fa-envelope"></i> {{ $contact->email ?? '------'}}</span>
                    </p>
                    <h5 class="text-muted text-center"><i class="fas fa-map-marker-alt"></i></h5>
                    <p class="text-muted px-2 text-center">{{ $contact->address ?? 'No Address Added!'}}</p>
                </div>
                <div class="mt-2 ">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-1">
                                <h5>{{$contact->message?->count()}}</h5>
                                <small class="mb-0 text-muted">Total Incoming</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-1">
                                <h5>{{$contact->recipient?->count()}}</h5>
                                <small class="mb-0 text-muted">Total Outgoing</small>
                            </div>
                        </div>
                    </div>
                </div>
                @if($contact->org_id === auth()->user()->organization->getRoot()->id)
                <div class="d-flex justify-content-end mt-2 border-top">
                   
                    <div class="mr-2">
                        <button class="btn btn-outline-warning btn-sm mr-1"
                        onclick="location.href='{{ route('contact.edit', $contact)}}';"><i
                            class="fas fa-pen"></i></button>
                    </div>

                    <div>
                        <a href="#delete_contact_helper_modal" class="btn btn-outline-danger btn-sm mr-1"
                        data-toggle="modal">
                        <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                    
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_contact_helper_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('contact.destroy',$contact) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">
                            Delete Contact confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($contact->message->count() || $contact->recipient->count())
                        <div class="form-group">
                            <label>{{$contact->name}} has sent {{$contact->message->count()}} messages and has had
                                {{$contact->recipient->count()}} messages sent to it.
                                To prevent loosing the messages upon contact deletion, please pick a contact to
                                pass the messages to.</label>
                            <x-dropdown 
                                :option="$contactsTree" 
                                name="transferContact" 
                                id="transferContactTo"
                                :multiple="false" 
                                :multiSelect="0"
                                placeholder="pick a contact to transfer messages to" 
                            />                                    
                            <script>
                                // register the component
                                Vue.component('treeselect', VueTreeselect.Treeselect);
                                let transferContactTo = new Vue({
                                    el: '#transferContactTo',
                                    data: {
                                        value: null,
                                        // define options
                                        options: {!!$contactsTree!!},
                                    },
                                });
                            </script>
                            @error('contact')
                            <div class="text-danger font-italic" style="font-size:0.8rem">*{{ $message }}
                            </div>
                            @enderror                            
                        </div>
                        @else 
                        <div class="d-flex justify-content-center align-item-center flex-column">
                            <h2 class="text-danger text-center" ><i class="fas fa-exclamation "></i></h2>
                            <p class="text-danger text-center">Are you sure you want to delete this contact?</p>
                        </div>
                        
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ཁ་རྒྱོབས།</button>
                        <button type="submit" class="btn btn-primary">གསོག་འཇོག་བྱོས།</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    @endif
</div>