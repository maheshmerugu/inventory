@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{('item-groups-masters-list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                    <input type="text" class="form-control form-control-lg" name="employee_code" id="employee_code" value="{{$item->employee_code}}" placeholder="Employee Code" oninput="validateEmployeeCode()" aria-label="Title" required>

                                    <span id="EmployeeCodeError" class="text-danger" style="display: none;">Employee Code must contain only Letters and Numbers</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Employee Name" name="employee_name" oninput="validateEmployeeName()" value="{{$item->employee_name}}" id="employee_name" aria-label="Title">
                                    <span id="EmployeeNameError" class="text-danger" style="display: none;">Employee Name must contain only Letters</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control form-control-lg" name="employee_designation" id="employee_designation" oninput="validateDesignation()" value="{{$item->employee_designation}}" placeholder="Designation" aria-label="Title">
                                    <span id="EmployeeDesignationError" class="text-danger" style="display: none;">Employee Designation must contain only Letters</span>
                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control form-control-lg" name="employee_mobile" id="employee_mobile" value="{{$item->employee_mobile}}" placeholder=" Mobile" aria-label="Title">
                                    <span id="EmployeeDesignationError" class="text-danger" style="display: none;">Employee Designation must contain only Letters</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Email" value="{{$item->employee_email}}" name="employee_email" id="employee_email" oninput="ValidateEmail()" aria-label="Title">
                                    <span id="EmployeeEmailError" class="text-danger" style="display: none;">Please Enter Valid Email address</span>

                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>District</label>


                                    <select class="form-control form-select" name="district" id="district">
                                        <option value="0" {{$item->district == '' ? 'selected' : ''}}>- District -</option>
                                        <option value="1" {{$item->district == 1 ? 'selected' : ''}}>Hyderabad</option>
                                        <option value="2" {{$item->district == 2 ? 'selected' : ''}}>Hyderabad</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control form-select" name="location" id="location">
                                        <option value="" {{$item->location == '' ? 'selected' : ''}}>- District -</option>
                                        <option value="1" {{$item->location == 1 ? 'selected' : ''}}>Hyderabad</option>
                                        <option value="2" {{$item->location == 2 ? 'selected' : ''}}>Hyderabad</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Display</label>
                                    <select class="form-control form-select" name="status"  id="status">
                                        <option value="" {{$item->status == '' ? 'selected' : ''}}>- Display -</option>
                                        <option value="1" {{$item->status == 1 ? 'selected' : ''}}>Yes</option>
                                        <option value="0" {{$item->status == 0 ? 'selected' : ''}}>No</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-12 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" id="address" placeholder="Address">{{$item->address}}</textarea>
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
    function validateLocationCode() {
        var groupCode = document.getElementById("location_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("LocationCodeError");
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

<<script>
    $("#company_form_btn").click(function(e) {
    e.preventDefault();
    let form = $('#company_form')[0];
    let data = new FormData(form);
    let itemId = "{{ $item->id }}"; // Assuming you have the item ID available

    $.ajax({
    url: "{{ route('employee.master.update', ['id' => $item->id]) }}", // Adjust the route with item ID parameter
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
    // Redirect to a specific URL after a delay of 2 seconds (2000 milliseconds)
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