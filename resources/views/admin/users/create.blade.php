@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('location.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">


        <div class="card badge-light">
            <div class="card-body">
                <form class="form-sample">
                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> Create User </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Id<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="user_id"   id="user_id" oninput="validateUserId()" placeholder="User Id" aria-label="Title">
                                <span id="UserIdError" class="text-danger" style="display: none;">User Id be letters only</span>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Section</label>
                                <select class="form-control form-select" name="role" id="role">
                                    <option value="">- Select Section -</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="Enter Selling Price" aria-label="KnowMore Url">
                                <span class="text-danger"> Enter User Name</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control form-control-lg" placeholder="User Id" aria-label="Title">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control form-select" name="blog_type" id="blog_type">
                                    <option value="0">- Select Role -</option>
                                    <option value="1">Article</option>
                                    <option value="2">Video</option>
                                    <option value="3">Interview QA</option>
                                </select>
                            </div>
                        </div>

                        <div class="co-lg-12 text-center mt-4">
                            <button type="button" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                SUBMIT</button>
                            <button type="button" class="btn btn-gradient-success btn-fw ">
                                <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div></div>
    </div>


</div>



<script>
    function validateUserId() {
        var groupCode = document.getElementById("user_id").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("UserIdError");
        if (!alphanumericRegex.test(groupCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function ValidateLocationName() {
        var location_name = document.getElementById("location_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("LocationNameError");
        if (!alphanumericRegex.test(location_name)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }



    function ValidateLocationShortName() {
        var vendorEmail = document.getElementById("location_short_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("LocationShortNameError");
        if (!alphanumericRegex.test(vendorEmail)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("#locationmaster_btn").click(function(e) {
        e.preventDefault();
        let form = $('#location_form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ route('location.master.store') }}",
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
                        window.location.href = "{{ route('location.master.list') }}";
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