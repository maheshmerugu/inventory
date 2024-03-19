@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('vendor.masters.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">

        <form id="vendormaster" method="POST">
            @csrf

            <div class="card badge-light">
                <div class="card-body">

                    <div class=" slider">
                        <div class="row">
                            <div class="col-lg-12 pb-3">
                                <h4 class=""> <b>Vendor Master</b></h4>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Vendor Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="vendor_code" id="vendor_code" placeholder="Vendor Id" oninput="validateVendorId()" aria-label="Title">

                                    <span id="vendorIdError" class="text-danger" style="display: none;">Vendor Id must contain only numbers and letters</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Vendor Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="vendor_name" id="vendor_name" oninput="ValidateVendorName()" placeholder="Vendor Name" aria-label="Title">

                                    <span id="vendorNameError" class="text-danger" style="display: none;">Vendor Name must contain only letters</span>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Vendor Email</label>
                                    <input type="text" class="form-control form-control-lg" name="vendor_email" id="vendor_email" placeholder="Vendor Email" oninput="ValidateEmail()" aria-label="Title">
                                    <span id="vendorEmailError" class="text-danger" style="display: none;">Vendor email must contain only email address</span>

                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Vendor Phone</label>
                                    <input type="text" class="form-control form-control-lg" name="vendor_phone" id="vendor_phone" oninput="ValidatePhoneNumber()" placeholder="Vendor Phone" aria-label="Title">
                                    <span id="vendorPhoneError" class="text-danger" style="display: none;">Please Enter Valid Phone Number</span>

                                </div>

                            </div>

                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Display</label>
                                    <select class="form-control form-select" name="status" id="status">
                                        <option value="">- Display -</option>
                                        <option value="0">In Active</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control form-select" name="vendor_city" id="vendor_city">
                                        <option value="">- Select City -</option>
                                        <option value="1">Hyderabad</option>
                                        <option value="2">Hyderabad</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-12 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="vendor_address" id="exampleFormControlTextarea1" rows="3" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="co-lg-12 text-center mt-4">
                                <button type="button" id="vendormaster_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                    SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>


        <div></div>
    </div>

</div>



<script>
    function validateVendorId() {
        var vendor_id = document.getElementById("vendor_id").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("vendorIdError");
        if (!alphanumericRegex.test(vendor_id)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function ValidateVendorName() {
        var vendorName = document.getElementById("vendor_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("vendorNameError");
        if (!alphanumericRegex.test(vendorName)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }



    function ValidateEmail() {
        var vendorEmail = document.getElementById("vendor_email").value;
        var emailregex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var errorElement = document.getElementById("vendorEmailError");
        if (!emailregex.test(vendorEmail)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }

    function ValidatePhoneNumber() {
        var vendorPhone = document.getElementById("vendor_phone").value;
        var phoneregex = /^\d{10}$/;
        var errorElement = document.getElementById("vendorPhoneError");
        if (!phoneregex.test(vendorPhone)) {
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
    $("#vendormaster_btn").click(function(e) {
        e.preventDefault();
        let form = $('#vendormaster')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ route('vendor.master.store') }}",
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
                        window.location.href = "{{ route('vendor.masters.list') }}";
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