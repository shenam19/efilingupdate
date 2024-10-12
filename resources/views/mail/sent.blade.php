<x-app-layout>
    <x-header>
        {{ __('བཏང་ཕྲིན།') }}
    </x-header>

    <section class="content">
      	<div class="row justify-content-center">
			@livewire('message-table',['type'=>'sent'])
    	</div>       
	</section>
</x-app-layout>
