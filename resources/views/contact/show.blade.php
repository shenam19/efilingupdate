<x-app-layout>
    <x-header>
        འབྱོར་སྒམ།
    </x-header>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">ལས་བྱེད་བཀོད་བྱུས།</h3>
                        <div class="text-right">
                            <a href="#create_contact_modal" class="btn btn-primary " data-toggle="modal">
                                <i class="fas fa-plus align-middle"></i><span> ལས་བྱེད་གསར་པ་ཆུགས།</span></a>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-wrap">                        
                        <div class="card m-2" style="width: 20rem;">
                            <div class="card-body" style="cursor:pointer;" onclick="location.href='{{ route('contact.show', $contact) }}';">
                                <h5 class="card-title">{{ $contact->name}}</h5>
                                <p class="card-text">{{ $contact->address}}</p>
                            </div>
                            <ul class="list-group list-group-flush" style="cursor:pointer;" onclick="location.href='{{ route('contact.show', $contact) }}';">
                                @if($contact->email)
                                <li class="list-group-item">{{ $contact->email}}</li>
                                @endif
                                @if($contact->phone)
                                <li class="list-group-item">{{ $contact->phone}}</li>
                                @endif
                            </ul>
                            <div class="card-footer text-muted d-flex">
                                <div>                                    
                                    <button class="btn btn-outline-warning btn-sm mr-1" onclick="location.href='{{ route('contact.edit', $contact)}}';"><i class="fas fa-pen"></i></button>
                                </div>                                
                                <div>
                                <form action="{{ route('contact.destroy',$contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');">
                                    @method('DELETE')
                                    @csrf                                    
                                    <button class="btn btn-outline-danger btn-sm mr-1" type="submit"><i class="far fa-trash-alt"></i></button>
                                </form>                                
                                </div>                                
                            </div>
                        </div>                       
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('contact.index')}}';" >back</button>
                    </div>
                </div>
            </div>
    </section>      
</x-app-layout>
