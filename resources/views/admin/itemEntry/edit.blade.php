@extends('layouts.app')

@section('content')
<style>
    .grid-margin .latest table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 23px 3px !important;
        vertical-align: middle;
        text-align: left !important;
        font-size: 14px !important;
        line-height: 17px;
    }


    .row {
        margin-top: 5px;
    }
</style>

<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>


<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('items.index')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                    <input type="text" name="po_number" placeholder="Enter PO Number" style="width: 120%;margin-left: -7PX;" value="{{$item->po_number}}" class="form-control" readonly />
                                    <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must contain only letters</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="margin-left: 24px;">Purchased Date<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="purchased_date"  value="{{$item->purchased_date}}" style="width: 81%;margin-left: 23px;" id="datepicker">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="margin-left: -71px;">Vendor<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="vendor_id" id="vendor_id" style="width: 87%; margin-left: -65px;">
                                        <option value="">- Select -</option>
                                        @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" @if($item->vendor_id == $vendor->id) selected @endif>{{ $vendor->vendor_name }}</option>
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
                                        <option value="{{ $group->id }}" @if($item->item_group_id == $group->id) selected @endif>{{ $group->group_name }}</option>

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
    $(function() {
        $("#datepicker").datepicker({

            dateFormat: "yy-mm-dd",


            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

        });
    });
</script>




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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>




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
                        window.location.href = "{{ route('items.index') }}";
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