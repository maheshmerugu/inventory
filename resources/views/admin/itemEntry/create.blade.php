@extends('layouts.app')

@section('content')
<style>

.grid-margin .latest table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 23px 3px !important;
    vertical-align: middle;
    text-align: left !important;
    font-size: 14px !important;
    line-height: 17px;
}


.row{
    margin-top: 5px;
}
</style>

<link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>


<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('courts.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf

            <div class="card badge-light">
                <div class="card-body">


                <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> Item Entry  </h4>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>PO Number<span class="text-danger">*</span></label>

                                <input type="text" name="item[0][amc_warrenty]" placeholder="Enter PO Number" class="form-control"/>
                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Purchased Date<span class="text-danger" >*</span></label>
                                <input type="text" class="form-control"  style="width: 250px; margin-left:-23px; height: 43px;" id="datepicker">                               

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Vendor<span class="text-danger">*</span></label>


                                <select class="form-control form-select" name="district_id" id="district_id" style="margin-left:-21px; width:256px;">
                                    <option value="">- Select  -</option>
                                    @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->vendor_id}}">{{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>

                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>

                            </div>
                        </div>



                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Item Group<span class="text-danger">*</span></label>


                                <select class="form-control form-select" name="district_id" id="district_id" style="margin-left:-28px; width:150px;">
                                    <option value="">- Select -</option>
                                    @foreach($item_groups as $group)
                                    <option value="{{ $group}}">{{ $group->group_name }}</option>
                                    @endforeach
                                </select>

                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>

                            </div>
                        </div>

                      

        

                    </div>

                    <div class="row">
                      
                        

                        <div class="col-md-4">
                            <table class="table table" id="dynamicTable">

                                <tr>
                                    <td ><input type="text" name="item[0][item_name]" placeholder="Enter Item Name" class="form-control" style="width:227px;" /></td>
                                    <td ><input type="text" name="item[0][serial_number]" placeholder="Enter Serial Number" class="form-control" style="width: 256px;margin-left:8px" /></td>
                                    <td ><input type="text" name="item[0][amc_warrenty]" placeholder="Enter Amc Warratety details" class="form-control" style="width: 256px;margin-left:8px" /></td>

                                    <td>
                                        <select style="width:150px;" class="form-control form-select" name="item[0][status]">
                                            <option value="">- Select Status -</option>
                                            <option value="0">Delivered</option>
                                            <option value="1" >Installed</option>
                                        </select>
                                    </td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                </tr>
                            </table>

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
        </form>
    </div>

</div>
<link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
    
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
    
    });
  });
  </script>

<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;

        $("#add").click(function() {
            ++i;
            var newRow = $('<tr>\
                        <td><input type="text" style="width:227px;"  name="item[' + i + '][name]" placeholder="Enter item Name" class="form-control" /></td>\
                        <td><input type="text" style="width: 256px;margin-left:8px" name="item[' + i + '][serialnumber]" placeholder="Enter Serial Number" class="form-control"  /></td>\
                        <td><input type="text" style="width: 256px;margin-left:8px" name="item[' + i + '][serialnumber]" placeholder="Enter Amc Warrenty Details" class="form-control"  /></td>\
                        <td><select class="form-control form-select status" name="court[' + i + '][status]" id="status_' + i + '">\
                            <option value="">- Select Status -</option>\
                            <option value="0">Delivered</option>\
                            <option value="1"  >Installed</option>\
                        </select></td>\
                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>\
                    </tr>');
            $('#dynamicTable').append(newRow);
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).closest('tr').remove();
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



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ route('courts.master.store') }}",
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