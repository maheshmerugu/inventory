@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Manage Roles </h4> <a href="{{('roles.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf
            <div class="card badge-light">
                <div class="card-body">
                    <div class=" ">
                        <div class="row">
                            <div class="col-lg-12 pb-4">
                                <h4 class=""> <b>Manage Roles</b></h4>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_name">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" name="role_name" class="form-control form-control-lg" id="role_name" placeholder="Role Name" aria-label="Title" required oninput="validateRoleName()">
                                </div>
                                <div id="roleNameError" class="text-danger" style="display:none;">Role Name is required</div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rolesh_name">Role Short Name</label>
                                    <input type="text" name="role_short_name" class="form-control form-control-lg" id="role_short_name" placeholder="Role short name" aria-label="KnowMore Url" required oninput="validateRoleShortName()">
                                </div>
                                <div id="roleShortNameError" class="text-danger" style="display:none;">Role Short Name is required</div>
                            </div>

                            <div class="col-md-4 mt-1">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control form-select" name="status" id="status">
                                        <option value="">- Select -</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-8">
                                <table class="table table" id="dynamicTable">
                                    <tr>
                                        <td><input type="text" name="court[0][role_name]" placeholder="Enter Role Name" class="form-control" /></td>
                                        <td><input type="text" name="court[0][role_short_name]" placeholder="Enter Short Name" class="form-control" /></td>
                                        <td>
                                            <select class="form-control form-select" name="court[0][status]">
                                                <option value="">- Select Status -</option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">In Active</option>
                                            </select>
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="co-lg-12 text-center mt-4">
                                <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <a href="{{route('roles.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;

        $("#add").click(function() {
            ++i;
            var newRow = $('<tr>\
                        <td><input type="text" name="court[' + i + '][role_name]" placeholder="Enter Role Name" class="form-control" /></td>\
                        <td><input type="text" name="court[' + i + '][role_short_name]" placeholder="Enter Short Name" class="form-control" /></td>\
                        <td><select class="form-control form-select status" name="court[' + i + '][status]" id="status_' + i + '">\
                            <option value="">- Select Status -</option>\
                            <option value="0">In Active</option>\
                            <option value="1" selected >Active</option>\
                        </select></td>\
                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>\
                    </tr>');
            $('#dynamicTable').append(newRow);
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
<script>
    function validateRoleName() {
        var roleName = document.getElementById("role_name").value;
        var alphanumericRegex = /^[a-zA-Z ]+$/;
        var errorElement = document.getElementById("roleNameError");

        if (!alphanumericRegex.test(roleName)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);
        $.ajax({
            url: "{{ route('roles.store') }}",
            type: "POST",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(response) {

                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            errorMsg += error + '<br>';
                        });
                    });
                    iziToast.error({
                        message: errorMsg,
                        position: 'topRight'
                    });

                } else {
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'

                    });
                    setTimeout(function() {
                        window.location.href = "{{ route('roles.list') }}";
                    }, 2000); // 2000 milliseconds = 2 seconds
                }
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    message: 'An error occurred: ' + error,
                    position: 'topRight'
                });
            }

        });

    })
</script>

@endsection