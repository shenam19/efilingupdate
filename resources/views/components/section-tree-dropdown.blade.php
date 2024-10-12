<div id="{{$id}}">
    <treeselect v-model="value" :multiple="false" :options="options" name="{{$name}}"/>
</div>

@push('scripts')
    <script>
        Vue.component('treeselect', VueTreeselect.Treeselect);
        let {{$id}} = new Vue({
            el: '#{{$id}}',
            data: {
                // define the default value
                value:  {{$selected ?? 'null'}} ,
                // define options
                options: {!!$orgs!!},
            },
        });
    </script>
@endpush