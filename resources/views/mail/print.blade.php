<x-app-layout>
    <x-header>
        མདུན་འཆར།
    </x-header>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
    <style>
    @media print {
        .pagebreak { 
            page-break-before: always; /* page-break-after works, as well */
        } 
    }
    @media print {
        .pagebreak_avoid {
            page-break-inside: avoid;
        }
    } 
    body {
        font-size:30px;
    }
    </style>
    @endpush

    <div class="received_msg">
        <div class="msg_header">

            <p>{{$message->subject}} <span class="time_date float-right">
                    {{$message->created_at->toDayDateTimeString()}}</span></p>
            <p class="time_date">གཏོང་མཁན། {{$message->getSenderName()}}</p>
            <p class="time_date">གཏོང་ཡུལ། {{$message->getRecipientsNames()}}</p>

        </div>
        <div class="msg_body">
            <p>{{$message->remarks}}</p>
            @foreach($message->attachments as $attachment)
            <a href="{{ route('media.show',$attachment->uuid)}}" target="_blank">
                @php
                $ext = getExtension($attachment->file_name)
                @endphp

                @if($ext === 'PDF')
                <i class="fas fa-file-pdf mr-3"></i>
                @elseif($ext === 'DOC' || $ext ==='DOCX')
                <i class="fas fa-file-word mr-3"></i>
                @else
                <i class="fas fa-file-image mr-3"></i>
                @endif
            </a>
            @endforeach
        </div>
    </div>
    <div class="messaging">
        <div class="">
            @if($message->forward_id)
            <div>
                <div class="headind_srch" style="border: 1px solid #c4c4c4;">
                    <div class="recent_heading">
                        <h4 class="text-center text-primary">ཟུར་མཆན། / Noting</h4>
                    </div>
                </div>
                <div class="accordion">
                    @while($message->forward_id)
                    <div class="chat_list pagebreak_avoid" style="border: 1px solid #c4c4c4;">
                        <div class="chat_people">
                            <div class="chat_ib ">
                                <p class="muted">{{ $message->created_at->toDayDateTimeString()}}</p>
                                <h5 style="font-size:30px;">{{$message->remarks}}</h5>
                                <div class="d-flex" style="font-size:18px">
                                    @foreach($message->attachments as $attachment)
                                    <a href="{{ route('media.show',$attachment->uuid)}}" target="_blank">
                                        @php
                                        $ext = getExtension($attachment->file_name)
                                        @endphp

                                        @if($ext === 'PDF')
                                        <i class="fas fa-file-pdf mr-3"></i>
                                        @elseif($ext === 'DOC' || $ext ==='DOCX')
                                        <i class="fas fa-file-word mr-3"></i>
                                        @else
                                        <i class="fas fa-file-image mr-3"></i>
                                        @endif
                                    </a>
                                    @endforeach
                                </div>
                                <p class="muted">མཆན་འགོད་ཡུལ།{{$message->getRecipientsNames()}}<span
                                        class="chat_date">མཆན་འགོད་མཁན། {{$message->getSenderName()}}</span></p>

                            </div>
                        </div>
                    </div>
                    @php
                    $message = $message->forwarded
                    @endphp
                    @endwhile
                </div>

                @endif
            </div>
        </div>

        @push('scripts')
        <script>            
            window.onload = function () {
                window.print();
            }
        </script>
        @endpush
</x-app-layout>