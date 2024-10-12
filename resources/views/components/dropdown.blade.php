<div id="{{$id}}">

    <treeselect 
        {{ $attributes }}
        v-model="value"  
        :options="options"  
        :flat="true"
        :flatten-search-results="true"
        :clearOnSelect="true"
    />
    
</div>
@push('scripts')
<script>

    // register the component
    Vue.component('treeselect', VueTreeselect.Treeselect);
    let {{$id}} = new Vue({
      	el: '#{{$id}}',
      	data: {
            @if($multiSelect)
                value:  [{{ $selected ? implode(',',$selected) : ''}}],
            @else
                value: {{$selected ?? 'null'}},
            @endif
			// define options
			options: {!! $option !!},
        },
        methods: {
            setRecipient: function (node, instanceId) {
                Livewire.emitTo('forward-message','setRecipients', node.id);
            },
            removeRecipient: function (node, instanceId) {
                Livewire.emitTo('forward-message','removeRecipient', node.id);
            },
            setParentContact: function (node, instanceId)
            {
                Livewire.emitTo('create-contact','setParentContact', node.id);
            },
            removeParentContact: function (node, instanceId)
            {
                Livewire.emitTo('create-contact','removeParentContact', node.id);
            },
            setSection: function (node, instanceId)
            {
                Livewire.emitTo('folder.display-file-lists','setSection', this.value);
            },
            setData: function (node, instanceId)
            {
                Livewire.emit('setData', node);
            },
            selectData: function (node, instanceId)
            {
                Livewire.emit('selectData', node.id);
            },
            unsetData: function (node, instanceId)
            {
                Livewire.emit('unsetData', node.id);
            },

            selectionChange: function(node, instanceId)            
            {                         
                Livewire.emitTo('show-contact-card','selectionChange', node.id);              
            }
        }
    });   

</script>
    
@endpush
