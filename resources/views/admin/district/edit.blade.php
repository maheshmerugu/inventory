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

                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> District </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{$item->name}}" oninput="validateDistrict()" placeholder="District" aria-label="Title">
                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control form-select" name="status" id="status">
                                    <option value="">- Select Status -</option>
                                    <option value="0" {{$item->status == 0 ? 'selected' : ''}}>InActive</option>
                                    <option value="1" {{$item->status == 1 ? 'selected' : ''}}>Active</option>
                                </select>
                            </div>
                        </div>



                        <div class="co-lg-12 text-center mt-4">
                            <button type="button" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                UPDATE</button>
                            <button type="button" class="btn btn-gradient-success btn-fw ">
                                <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>

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

<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);
        let itemId = "{{ $item->id }}"; // Assuming you have the item ID available

        $.ajax({
            url: "{{ route('district.master.update', ['id' => $item->id]) }}", // Adjust the route with item ID parameter
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
                        window.location.href = "{{ route('district.master.list') }}";
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