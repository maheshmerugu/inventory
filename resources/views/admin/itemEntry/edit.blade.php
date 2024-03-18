@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('inventory.request.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf

            <div class="card badge-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> Item Entry </h4>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>PO Number<span class="text-danger">*</span></label>
                                    <input type="text" name="po_number" placeholder="Enter PO Number" style="width: 120%;margin-left: -7PX;" value="{{$item->po_number}}" class="form-control" />
                                    <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="margin-left: 24px;">Purchased Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="purchased_date" value="{{$item->purchased_date}}" style="width: 81%;margin-left: 23px;" id="datepicker">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="margin-left: -71px;">Vendor<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="vendor_id" id="vendor_id" style="width: 87%; margin-left: -65px;">
                                        <option value="">- Select -</option>
                                        @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->vendor_id }}" @if($item->vendor_id == $vendor->vendor_id) selected @endif>{{ $vendor->vendor_name }}</option>
                                        @endforeach
                                    </select>

                                    <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="    margin-left: -116px;">Item Group<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="item_group_id" id="item_group_id" style="margin-left: -113px;">
                                        <option value="">- Select -</option>
                                        @foreach($item_groups as $group)
                                        <option value="{{ $group->group_code }}" @if($item->item_group_id == $group->group_code) selected @endif>{{ $group->group_name }}</option>

                                        @endforeach

                                    
                                    </select>
                                    <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label style="margin-left:7px;">Item Name<span class="text-danger">*</span></label>
                                <input type="text" name="item_name" value="{{$item->item_name ?? ''}}" placeholder="Enter Item Name" style="width: 118%;margin-left: 3px;" class="form-control" />
                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="margin-left: 24px;">Serial Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="serial_number" value="{{$item->serial_number ?? ''}}" placeholder="Enter Serial Number" style="width: 81%;margin-left: 23px;" id="datepicker">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="margin-left: -71px;">Amc Details<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Amc Details" name="amc_warrenty" value="{{$item->amc_warrenty ?? ''}}" id="vendor_id" style="width: 87%;margin-left: -65px;" />

                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label style="    margin-left: -116px;">Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="status" id="status" style="margin-left: -113px;">
                                    <option value="">- Select Status -</option>
                                    <option value="0" {{$item->status == 0 ? 'selected' : ''}}>Delivered</option>
                                    <option value="1" {{$item->status == 1 ? 'selected' : ''}}>Installed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-4">
                            <button type="button" id="company_form_btn" class="btn btn-info"><i class="mdi mdi-arrow-right-bold-hexagon-outline"></i> UPDATE</button>
                            <button type="button" class="btn btn-gradient-success btn-fw"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>
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
            url: "{{ route('items.update', ['id' => $item->id]) }}", // Adjust the route with item ID parameter
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
                        window.location.href = "{{ route('inventory.request.list') }}";
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