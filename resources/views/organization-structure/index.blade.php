<x-app-layout>
    <x-header>
        སྒྲིག་འཛུགས་ཀྱི་སྒྲོམ་གཞི།
    </x-header>
        
    <div style="overflow-x: scroll">
        <div id="mainTree" class="tree" style="width: max-content;"></div>
    </div>
            
    <!-- edit Org Modal -->
    @include('organization-structure.partials.edit-modal')
    
    <!-- Add Child Modal -->
    @include('organization-structure.partials.add-child-modal')

    @push('scripts')
    <script>
        function DFS(node, attach) {
            // Create a Queue and add our initial node in it
            let ul = document.createElement("ul");
            let li = document.createElement("li");
            let a = document.createElement("a");
            a.text = node.name_short;
            a.setAttribute("data-id", node.id);
            a.setAttribute("data-short", node.name_short);
            a.setAttribute("data-name", node.name);
            a.setAttribute("data-toggle", "modal");
            a.setAttribute("data-target", "#editOrgModal");
            li.appendChild(a);
            ul.appendChild(li);
            attach.appendChild(ul);

            let q = [];
            let domQueue = [];
            q.push(node);
            domQueue.push(li);

            // We'll continue till our Queue gets empty
            while (q.length) {
                let t = q.shift();
                let dq = domQueue.shift();

                //if leaf node, no more ul
                if (t.children.length > 0) {
                    ul = document.createElement('ul');
                    dq.appendChild(ul);
                }
                //each node gets a li, a
                t.children.forEach(c => {
                    let li = document.createElement("li");
                    let a = document.createElement("a");
                    a.text = c.name_short;
                    a.setAttribute("data-id", c.id);
                    a.setAttribute("data-short", c.name_short);
                    a.setAttribute("data-name", c.name);                    

                    a.setAttribute("data-toggle", "modal");
                    a.setAttribute("data-target", "#editOrgModal");
                    li.appendChild(a);
                    ul.appendChild(li);
                    domQueue.push(li);
                    q.push(c);
                });
            }
        }
        $(document).ready(function () {
            const orgs = {!!$orgs!!};
            const mainTree = document.getElementById("mainTree");
            DFS(orgs[0], mainTree);
            $('a').click(function () {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    value: $(this).data('id')
                }).appendTo('#editOrgForm');
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    value: $(this).data('id')
                }).appendTo('#addChildForm');
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    value: $(this).data('id')
                }).appendTo('#deleteOrgForm');
                $('#nameShortInput').val($(this).data('short'));
                $('#fullNameInput').val($(this).data('name'));                
            });
        });
    </script>
    @endpush
</x-app-layout>
