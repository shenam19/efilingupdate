<x-app-layout>
    <x-header>
        ལས་བྱེད་བཀོད་བྱུས།
    </x-header>

    <div class="container-fluid">

        <div class="card card-secondary">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title">ལས་བྱེད་བཀོད་བྱུས།</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="#addEmployeeModal" class="btn btn-primary " data-toggle="modal">
                            <i class="fas fa-plus align-middle"></i><span> ལས་བྱེད་གསར་པ་ཆུགས།</span></a>
                        <a id="anchorDelete" href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                            <i class="fa fa-times align-middle"></i><span> སུབ།</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th class="text-lg">མིང་།</th>
                        <th class="text-lg">སྤྱོད་མིང་ངོ་རྟགས།</th>
                        <th class="text-lg">གནས་རིམ།</th>
                        <th class="text-lg">ལས་ཁུངས།</th>
                        <th class="text-lg">འགྱུར་བཅོས།</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input class="staffCheckBox" type="checkbox" name="staff" value="{{$staff->id}}">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td>{{$staff->name}}</td>
                        <td>{{$staff->email}}</td>
                        <td>
                            @if($staff->position != null)
                            {{$staff->position->name_tibetan}}
                            @endif

                        </td>
                        <td>{{$staff->organization->name_short}}</td>
                        <td>
                            <a href="#editEmployeeModal" data-id="{{$staff->id}}" data-name="{{ $staff->name }}"
                                @if($staff->position != null)
                                    data-position={{$staff->position->id}}
                                @endif
                                data-email="{{ $staff->email }}"
                                data-orgid="{{$staff->works_at}}"
                                class="text-warning edit"
                                data-toggle="modal">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="#deleteSingleEmployeeModal" data-id="{{$staff->id}}" data-name="{{ $staff->name }}"
                                data-email="{{ $staff->email }}" class="text-danger delete" data-toggle="modal">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                {{ $staffs->links() }}
            </div>
        </div>
    </div>

    </div>

    <!-- Add Modal -->
    @include('manage-staff.partials.add-modal')

    <!-- Edit Modal -->
    @include('manage-staff.partials.edit-modal')

    <!-- Multi Delete Modal HTML -->
    @include('manage-staff.partials.multi-delete-modal')

    <!-- Single Delete Modal HTML -->
    @include('manage-staff.partials.single-delete-modal')

    @push('scripts')
    <script>
        $(document).ready(function () {
            //when deleteStaffForm is submitted, collect all the values of checked checkbox
            //and append it as input array staffList[]
            $("#deleteStaffForm").submit(function (eventObj) {
                let staffList = [];
                $('input[type=checkbox][name=staff]:checked').each(function () {
                    staffList.push($(this).val());
                });
                if (staffList.length === 0) {
                    return false;
                }

                for (const i of staffList) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'staffList[]',
                        value: i
                    }).appendTo('#deleteStaffForm')
                }
                return true;
            });

            // For multiple delete
            //Delete modal enable submit button and delete message output
            $("#anchorDelete").click(function () {
                let staffList = [];
                $('input[type=checkbox][name=staff]:checked').each(function () {
                    staffList.push($(this).val());
                });
                if (staffList.length === 0) {
                    $("#deleteStaffSubmitBtn").attr("disabled", "disabled");
                    $("#deleteStaffMessage").text("ལས་བྱེད་བསུབ་རྒྱུ་མིན་འདུག")
                } else {
                    $("#deleteStaffSubmitBtn").removeAttr("disabled");
                    $("#deleteStaffMessage").text("ཁྱེད་ཀྱིས་ལས་བྱེད་ " + staffList
                        .length + " བསུབ་རྒྱུ་གཏན་ཁེལ་ཡིན་ནམ།")
                }

            });

            // For single delete
            $('.delete').click(function () {

                $("#deleteSingleStaffMessage").text("ཁྱེད་ཀྱིས་ལས་བྱེད་ " + $(this).data(
                    'name') + " (" + $(this).data('email') + ") བསུབ་རྒྱུ་གཏན་ཁེལ་ཡིན་ནམ།")
                $('<input>').attr({
                    type: 'hidden',
                    name: 'staffList[]',
                    value: $(this).data('id')
                }).appendTo('#deleteSingleStaffForm')
            });

            // For edit
            $('.edit').click(function () {
                $('#editName').val($(this).data('name'));                
                orgTreeSelectEdit.value = $(this).data('orgid');
                $('#editEmail').val($(this).data('email'));
                $(`#editPosition option[value="${$(this).data('position')}"]`).attr("selected",
                    "selected");
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    value: $(this).data('id')
                }).appendTo('#editForm');
                
            });
        });
    </script>

    @endpush

</x-app-layout>
