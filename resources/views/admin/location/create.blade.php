@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('location.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="card badge-light">
            <div class="card-body">
                <form id="location_form" method="POST">
                    @csrf
                    <div class=" slider">
                        <div class="row">
                            <div class="col-lg-12 pb-3">
                                <h4 class=""> <b>Location Master</b></h4>

                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Location Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="location_code" id="location_code" placeholder="Location  Code" oninput="validateLocationCode()" aria-label="Title">
                                    <span id="LocationCodeError" class="text-danger" style="display: none;">Location Code must contain only numbers and letters</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Location Name</label>
                                    <input type="text" class="form-control form-control-lg" name="location_name" oninput="ValidateLocationName()" id="location_name" placeholder="Location Name" aria-label="Title">
                                    <span id="LocationNameError" class="text-danger" style="display: none;">Location Name Must be letters only</span>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Location Short Name</label>
                                    <input type="text" class="form-control form-control-lg" name="location_short_name" id="location_short_name" placeholder="Vendor Short Name" oninput="ValidateLocationShortName()" aria-label="Title">
                                    <span id="LocationShortNameError" class="text-danger" style="display: none;">Location Short Name Must be letters only</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>District <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="district" id="district">
                                            <option value="0">- District -</option>
                                            <option value="1">Hyderabad</option>
                                            <option value="2">Hyderabad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="0">- Active -</option>
                                            <option value="1">Active</option>
                                            <option value="2">In Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3 mt-1">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="co-lg-12 text-center mt-4">
                                <button type="button" id="locationmaster_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                    SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div></div>
    </div>
</div>
<script>
    function validateLocationCode() {
        var groupCode = document.getElementById("location_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9\s]+$/;
        var errorElement = document.getElementById("LocationCodeError");
        if (!alphanumericRegex.test(groupCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }
    function ValidateLocationName() {
        var location_name = document.getElementById("location_name").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/; // Including \s for spaces
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