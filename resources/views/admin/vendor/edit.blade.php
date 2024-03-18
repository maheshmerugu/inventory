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
                                    <h4 class=""> <b>Vendor Master</b></h4>

                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Vendor Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="vendor_code"  value="{{$item->vendor_code }}"  id="vendor_id" placeholder="Vendor Id" oninput="validateVendorId()" aria-label="Title">

                                        <span id="vendorIdError" class="text-danger" style="display: none;">Vendor Id must contain only numbers and letters</span>

                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Vendor Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="vendor_name" id="vendor_name"  value="{{$item->vendor_name }}"  oninput="ValidateVendorName()" placeholder="Vendor Name" aria-label="Title">

                                        <span id="vendorNameError" class="text-danger" style="display: none;">Vendor Name must contain only letters</span>

                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Vendor Email</label>
                                        <input type="text" class="form-control form-control-lg" name="vendor_email"   value="{{$item->vendor_email }}"    id="vendor_email" placeholder="Vendor Email" oninput="ValidateEmail()" aria-label="Title">
                                        <span id="vendorEmailError" class="text-danger" style="display: none;">Vendor email must contain only email address</span>

                                    </div>

                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Vendor Phone</label>
                                        <input type="text" class="form-control form-control-lg" name="vendor_phone" value="{{$item->vendor_phone }}"   id="vendor_phone" oninput="ValidatePhoneNumber()" placeholder="Vendor Phone" aria-label="Title">
                                        <span id="vendorPhoneError" class="text-danger" style="display: none;">Please Enter Valid Phone Number</span>

                                    </div>

                                </div>

                                <div class="col-sm-4 mb-3 mt-1">
                                   


                                    <div class="form-group">
                                        <label for="status">Display</label>
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="" {{$item->status == '' ? 'selected' : ''}}>- Display -</option>
                                            <option value="0" {{$item->status == 0 ? 'selected' : ''}}>Inactive</option>
                                            <option value="1" {{$item->status == 1 ? 'selected' : ''}}>Active</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-4 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select class="form-control form-select" value="{{$item->vendor_city }}" name="vendor_city" id="vendor_city">
                                            <option value="" {{$item->vendor_city == '' ? 'selected' : ''}}>- Select City -</option>
                                            <option value="0" {{$item->vendor_city == 1 ? 'selected' : ''}}>Hyderabad</option>
                                            <option value="1" {{$item->vendor_city == 1 ? 'selected' : ''}}>Hyderabad</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-12 mb-3 mt-1">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control"  id="exampleFormControlTextarea1" name="vendor_address" rows="3" placeholder="Address">{{$item->vendor_address}}</textarea>
                                    </div>
                                </div>
                                <div class="co-lg-12 text-center mt-4">
                                    <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                        UPDATE</button>
                                    <button type="submit" class="btn btn-gradient-success btn-fw ">
                                        <a href="" class="mdi mdi-arrow-left-bold-circle"></a> BACK</button>

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
        let itemId = "{{ $item->id }}"; // Assuming you have the item ID available

        $.ajax({
            url: "{{ route('vendor.master.update', ['id' => $item->id]) }}", // Adjust the route with item ID parameter
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