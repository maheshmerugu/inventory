@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('courts.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf

            <div class="card badge-light">
<<<<<<< HEAD
            <div class="card-body">
                                    <form class="form-sample">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="text" class="form-control form-control-lg" name="current_password" placeholder="Old Password" aria-label="Title">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="text" name="new_password" class="form-control form-control-lg" placeholder="New Password" aria-label="Sub Title">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="text" name="new_password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" aria-label="Username">
                                                </div>
                                            </div>




                                            <div class="co-lg-12 text-center mt-4">
                                                <button id="company_form_btn" type="button" class="btn btn-info "> SUBMIT</button>
                                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                                    BACK</button>

                                            </div>
                                    
                                </div></form>
                            </div>
=======
                <div class="card-body">
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control form-control-lg" name="current_password" placeholder="Old Password" aria-label="Title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control form-control-lg" placeholder="New Password" aria-label="Sub Title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" aria-label="Username">
                                </div>
                            </div>




                            <div class="co-lg-12 text-center mt-4">
                                <button id="company_form_btn" type="button" class="btn btn-info "> SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    BACK</button>

                            </div>

                        </div>
                    </form>
                </div>
>>>>>>> origin/main
            </div>
        </form>
    </div>

</div>




<script>
    function validateDistrict() {
        var EmployeeName = document.getElementById("name").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/;
        var errorElement = document.getElementById("DistrictNameError");
        if (!alphanumericRegex.test(EmployeeName)) {
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
            url: "{{ route('user.password.save') }}",
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
                        window.location.href = "{{ route('courts.master.list') }}";
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