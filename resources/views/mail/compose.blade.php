<x-app-layout>
    <x-header>
        {{ __('གནད་དོན་བྲིས།') }}
    </x-header>
    <!-- Main content -->
    @include('mail.partials.compose-form',['type'=>'compose'])
    @push('scripts')
    <script>
    $(document).ready(function (){
        $("#allOfficeCheckbox").change(function (){
            if (this.checked === true) 
            {   
                const officeRecipients = new Set(recipientSelect.value);
                for (var i = 0; i < recipientSelect.options.length; i++) 
                {
                    if(!recipientSelect.options[i].is_colleague)
                    {
                        officeRecipients.add(recipientSelect.options[i].id);
                    }
                }
                recipientSelect.value = Array.from(officeRecipients);
            } 
            else 
            {
                for (var i = 0; i < recipientSelect.options.length; i++) 
                {
                    if(!recipientSelect.options[i].is_colleague)
                    {
                        recipientSelect.value.pop(recipientSelect.options[i].id);
                    }
                }
            }
        });

        $("#allColleagueCheckbox").change(function () {

            if (this.checked === true) 
            {   
                const colleagueRecipients = new Set(recipientSelect.value);
                for (var i = 0; i < recipientSelect.options.length; i++) 
                {
                    if(recipientSelect.options[i].is_colleague)
                    {
                        colleagueRecipients.add(recipientSelect.options[i].id);
                    }
                }
                recipientSelect.value = Array.from(colleagueRecipients);
            } 
            else 
            {  
                for (var i = 0; i < recipientSelect.options.length; i++) 
                {
                    if(recipientSelect.options[i].is_colleague)
                    {
                        recipientSelect.value.pop(recipientSelect.options[i].id);
                    }
                }
            }
        });

        $("#discard").click(function(){
                $('#composeSelect2 option').each(function(){                
                    $(this).removeAttr( "selected" );                    
                });
                $('#composeSelect2').trigger('change');
            });
        $("#message_type_dd").change(function(){
            const id = this.value;
            const typeName = $(this).find("option:selected").text();
            console.log(typeName);
            switch(typeName)
            {
                case 'announcement':
                    break;
                case 'permission':
                    break;
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
