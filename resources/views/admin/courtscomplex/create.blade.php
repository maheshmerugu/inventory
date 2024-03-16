@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{route('courts.complex.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
    <form id="company_form" method="POST" action="{{ route('courts.complex.store') }}">
            @csrf

            <div class="card badge-light">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> Courts Complex </h4>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>District<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="district_id" id="district_id">
                                    <option value="">- Select District -</option>
                                    @foreach($all_districts as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <table class="table table" id="dynamicTable">

                                <tr>
                                    <td><input type="text" name="court[0][complex_name]" placeholder="Enter Complex Name" class="form-control" /></td>
                                    <td>
                                        <select class="form-control form-select" name="court[0][status]">
                                            <option value="">- Select Status -</option>
                                            <option value="1" selected>Active</option>
                                            <option value="0">In Active</option>
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
                            <a href="{{route('courts.complex.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        var i = 0;

        $("#add").click(function() {
            ++i;
            var newRow = $('<tr>\
                        <td><input type="text" name="court[' + i + '][complex_name]" placeholder="Enter Complex Name" class="form-control" /></td>\
                        <td><select class="form-control form-select status" name="court[' + i + '][status]" id="status_' + i + '">\
                            <option value="">- Select Status -</option>\
                            <option value="0">In Active</option>\
                            <option value="1" selected >Active</option>\
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ route('courts.complex.store') }}",
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
                        window.location.href = "{{ route('courts.complex.list') }}";
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