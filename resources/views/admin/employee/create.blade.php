@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('employee.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">


        <form id="company_form" method="POST">
            @csrf

            <div class="card badge-light">
                <div class="card-body">

                    <div class=" slider">
                        <div class="row">
                            <div class="col-lg-12 pb-3">
                                <h4 class=""> <b>Employee Master</b></h4>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Employee Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="employee_code" id="employee_code" placeholder="Employee Code" oninput="validateEmployeeCode()"  aria-label="Title" required>

                                    <span id="EmployeeCodeError" class="text-danger" style="display: none;">Employee Code must contain only Letters and Numbers</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Employee Name" name="employee_name" oninput="validateEmployeeName()" id="employee_name" aria-label="Title">
                                    <span id="EmployeeNameError" class="text-danger" style="display: none;">Employee Name must contain only Letters</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control form-control-lg" name="employee_designation" id="employee_designation" oninput="validateDesignation()" placeholder="Designation" aria-label="Title">
                                    <span id="EmployeeDesignationError" class="text-danger" style="display: none;">Employee Designation must contain only Letters</span>
                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control form-control-lg" name="employee_mobile" oninput="ValidatePhoneNumber()" id="employee_mobile" placeholder=" Mobile" aria-label="Title">
                                    <span id="EmployeeMobileError" class="text-danger" style="display: none;">Employee Phone Numbes Must be Numbers only</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-lg"  placeholder="Email"  name="employee_email" id="employee_email" oninput="ValidateEmail()"   aria-label="Title">
                                    <span id="EmployeeEmailError" class="text-danger" style="display: none;">Please Enter Valid Email address</span>

                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>District</label>
                                    <select class="form-control form-select" name="district" id="district">
                                        <option value="">- District -</option>
                                        <option value="1">Hyderabad</option>
                                        <option value="2">Hyderabad</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control form-select" name="location" id="location">
                                        <option value="0">- Location -</option>
                                        <option value="1">Hyderabad</option>
                                        <option value="2">Hyderabad</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Display</label>
                                    <select class="form-control form-select" name="status" id="status">
                                        <option value="">- Display -</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-12 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" id="address" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="co-lg-12 text-center mt-4">
                                <button type="button" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                    SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
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
    function validateEmployeeCode() {
        var employeeCode = document.getElementById("employee_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("EmployeeCodeError");
        if (!alphanumericRegex.test(employeeCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function validateEmployeeName() {
        var EmployeeName = document.getElementById("employee_name").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/;
        var errorElement = document.getElementById("EmployeeNameError");
        if (!alphanumericRegex.test(EmployeeName)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


   

    function ValidatePhoneNumber() {
        var Phone = document.getElementById("employee_mobile").value;
        var phoneregex = /^\d{10}$/;
        var errorElement = document.getElementById("EmployeeMobileError");
        if (!phoneregex.test(Phone)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function ValidateEmail() {
        var vendorEmail = document.getElementById("employee_email").value;
        var emailregex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var errorElement = document.getElementById("EmployeeEmailError");
        if (!emailregex.test(vendorEmail)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }



    function validateDesignation() {
        var groupName = document.getElementById("employee_designation").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/;
        var errorElement = document.getElementById("EmployeeDesignationError");
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
            url: "{{ route('employee.master.store') }}",
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
                        window.location.href = "{{ route('employee.master.list') }}";
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