@extends('layouts.app')

@section('content')
   <div class="page-header">
        <h4 class=""> Master </h4> <a href="{{route('itemgroup.masters.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                    <h4 class=""> <b>Item Group Master</b></h4>

                                </div>
                                <div class="col-sm-4 mb-1 mt-1">
                                    <div class="form-group">
                                        <label>Group Code <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="group_code" id="group_code" class="form-control" placeholder="Group Code" required oninput="validateGroupCode()">
                                        </div>
                                        <span id="groupCodeError" class="text-danger" style="display: none;">Group Code must contain only numbers and letters</span>

                                    </div>

                                </div>
                                <div class="col-sm-4 mb-1 mt-1">
                                    <div class="form-group">
                                        <label>Group Name </label>
                                        <div class="input-group">
                                            <input type="text" name="group_name" id="group_name" class="form-control" placeholder=" Group Name" oninput="validateGroupName()">

                                        </div>
                                        <span id="groupNameError" class="text-danger" style="display: none;">Group Code must contain only letters</span>

                                    </div>

                                </div>
                                <div class="col-sm-4 mb-1 mt-1">
                                    <div class="form-group">
                                        <label>Group Short Name </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="group_short_name" id="group_short_name" placeholder="Group Short Name" required minlength="2" oninput="validateShortName()">

                                        </div>
                                        <span id="groupShortNameError" class="text-danger" style="display: none;">Group Code must contain only letters</span>
                                    </div>

                                </div>
                                <div class="col-sm-4 mb-1 mt-1">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="0">- Active -</option>
                                            <option value="1">Active</option>
                                            <option value="2">In Active</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="co-lg-12 text-center mt-4">
                                    <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline " ></i>
                                        SUBMIT</button>
                                    <button type="submit" class="btn btn-gradient-success btn-fw ">
                                        <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>

                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </form>


        </div>

    </div>

    

<script>
    function validateGroupCode() {
        var groupCode = document.getElementById("group_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("groupCodeError");
        if (!alphanumericRegex.test(groupCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function validateGroupName() {
        var groupName = document.getElementById("group_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("groupNameError");
        if (!alphanumericRegex.test(groupName)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }



    function validateShortName() {
        var groupName = document.getElementById("group_short_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("groupShortNameError");
        if (!alphanumericRegex.test(groupName)) {
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
            url: "{{ route('itemgroup.master.store') }}",
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
                        window.location.href = "{{ route('itemgroup.masters.list') }}";
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