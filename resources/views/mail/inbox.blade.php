<x-app-layout>
    <x-header>
        {{ __('འབྱོར་སྒམ།') }}
    </x-header>

    <section class="content">
      	<div class="row justify-content-center">
        	@livewire('message-table',['type'=>'inbox'])
    	</div>       
	</section>
    
</x-app-layout>
