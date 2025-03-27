<div id="{{ $id }}">

    <treeselect {{ $attributes }} v-model="value" :options="options" :flat="true"
        :flatten-search-results="true" :clearOnSelect="true" />

</div>
@push('scripts')
    <script>
        // register the component
        Vue.component('treeselect', VueTreeselect.Treeselect);
        let {{ $id }} = new Vue({
            el: '#{{ $id }}',
            data: {
                @if ($multiSelect)
                    value: [{{ $selected ? implode(',', $selected) : '' }}],
                @else
                    value: {{ $selected ?? 'null' }},
                @endif
                // define options
                options: {!! $option !!},
            },
            // methods: {
            //     setRecipient: function(node, instanceId) {
            //         Livewire.emitTo('forward-message', 'setRecipients', node.id);
            //     },
            //     removeRecipient: function(node, instanceId) {
            //         Livewire.emitTo('forward-message', 'removeRecipient', node.id);
            //     },
            //     setParentContact: function(node, instanceId) {
            //         Livewire.emitTo('create-contact', 'setParentContact', node.id);
            //     },
            //     removeParentContact: function(node, instanceId) {
            //         Livewire.emitTo('create-contact', 'removeParentContact', node.id);
            //     },
            //     setSection: function(node, instanceId) {
            //         Livewire.emitTo('folder.display-file-lists', 'setSection', this.value);
            //     },
            //     setData: function(node, instanceId) {
            //         Livewire.emit('setData', node);
            //     },
            //     selectData: function(node, instanceId) {
            //         Livewire.emit('selectData', node.id);
            //     },
            //     unsetData: function(node, instanceId) {
            //         Livewire.emit('unsetData', node.id);
            //     },

            //     selectionChange: function(node, instanceId) {
            //         Livewire.emitTo('show-contact-card', 'selectionChange', node.id);
            //     }
            // }

            methods: {
                setRecipient: function(node, instanceId) {
                    // Livewire.emitTo('forward-message', 'setRecipients', node.id);
                    Livewire.dispatchTo('forward-message', 'setRecipients', {
                        id: [node.id]
                    });






                },
                removeRecipient: function(node, instanceId) {
                    // Livewire.emitTo('forward-message', 'removeRecipient', node.id);

                    Livewire.dispatchTo('forward-message', 'removeRecipient', {
                        id: [node.id]
                    });

                },
                setParentContact: function(node, instanceId) {
                    // Livewire.emitTo('create-contact', 'setParentContact', node.id);
                    Livewire.dispatchTo('create-contact', 'setParentContact', {
                        id: [node.id]
                    });
                },
                removeParentContact: function(node, instanceId) {
                    // Livewire.emitTo('create-contact', 'removeParentContact', node.id);
                    // Livewire.dispatchTo('removeParentContact', 'create-contact', {
                    //     id: [node.id]
                    // });
                    Livewire.dispatchTo('create-contact', 'removeParentContact', {
                        id: [node.id]
                    });
                },
                setSection: function(node, instanceId) {
                    // Livewire.emitTo('folder.display-file-lists', 'setSection', this.value);
                    Livewire.dispatch('setSection', {
                        value: this.value
                    }).to('folder.display-file-lists');

                },
                setData: function(node, instanceId) {
                    // Livewire.emit('setData', node);
                    const cleanNode = Array.isArray(node) ? node.slice() : (node.value || []);

                    Livewire.dispatch('setData', cleanNode);
                },


                selectData: function(node, instanceId) {
                    Livewire.dispatch('selectData', {
                        selected: [node.id]
                    });
                    // Livewire.emit('selectData', node.id);
                },
                unsetData: function(node, instanceId) {
                    Livewire.dispatch('unsetData', {
                        selected: [node.id]
                    });
                    // Livewire.emit('unsetData', node.id);
                },

                selectionChange: function(node, instanceId) {
                    // Livewire.emitTo('show-contact-card', 'selectionChange', node.id);
                    Livewire.dispatchTo('show-contact-card', 'selectionChange', {
                        contact: [node.id]
                    });
                    // $this - > dispatch('selectionChange', id: $node - > id) - > to('show-contact-card');





                }
            }
        });
    </script>
@endpush
