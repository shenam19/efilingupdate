<x-app-layout>
    <x-header>
        ཟིན་བྲིས་སྟོན།
    </x-header>
    <!-- Main content -->
    @include('mail.partials.compose-form',['type'=>'draft'])
    @push('scripts')
    <script>
        $(document).ready(function() {                     
            $('#subject').val("{{$message->subject}}");
            $('#remarks').val("{{$message->remarks}}");
            $('#message_type_dd').val("{{$message->message_type_id}}")
            
            let picked = {{$message->recipients->pluck('user_id')}};
            $('#composeSelect2 option').each(function(){                
                if(picked.includes(parseInt($(this).val()))){
                    $(this).attr("selected","selected");
                }
            });                 
            $('#composeSelect2').trigger('change');       
            @if(isset($letterNumber))
                $('#letterNumber').val("{{$letterNumber}}");
            @endif
            $("#allOfficeCheckbox").change(function () {
                if (this.checked === true) {
                    $(".office").attr("selected","selected");
                    $('#composeSelect2').trigger('change');
                } else {
                    $(".office").removeAttr( "selected" );
                    $('#composeSelect2').trigger('change');
                }
            });
            $("#allColleagueCheckbox").change(function () {
                if (this.checked === true) {
                    $(".colleague").attr("selected","selected");
                    $('#composeSelect2').trigger('change');
                } else {
                    $(".colleague").removeAttr( "selected" );
                    $('#composeSelect2').trigger('change');
                }
            });
            $("#discard").click(function(){
                $('#composeSelect2 option').each(function(){                
                    $(this).removeAttr( "selected" );                    
                });
                $('#composeSelect2').trigger('change');
            });
        });
    </script>
    @endpush
</x-app-layout>
