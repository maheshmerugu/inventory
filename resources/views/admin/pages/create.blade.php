@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Manage Page </h4> <a href="{{('page.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf
            <div class="card badge-light">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Page Section<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="pages_section_id" id="pages_section_id">
                                    <option value="">- Select Page Section -</option>
                                    @foreach($all_sections as $status)
                                    <option value="{{ $status->id }}">{{ $status->page_section_name ?? ''}}</option>
                                    @endforeach
                                </select>
                                <span id="PageSectionNameError" class="text-danger" style="display: none;">Page Section must be contain only Letters</span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table class="table table" id="dynamicTable">
                                <tr>
                                    <td><input type="text" name="pagesection[0][page_name]" placeholder="Enter Page Name" class="form-control" /></td>
                                    <td><input type="text" name="pagesection[0][page_url]" placeholder="Enter Page Url" class="form-control" /></td>
                                    <td>
                                        <select class="form-control form-select" name="pagesection[0][status]">
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
                            <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                            <button type="button" class="btn btn-gradient-success btn-fw ">
                                <a href="{{route('page.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
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
                        <td><input type="text" name="pagesection[' + i + '][page_name]" placeholder="Enter Page Name" class="form-control" /></td>\
                        <td><input type="text" name="pagesection[' + i + '][page_url]" placeholder="Enter Page Url" class="form-control" /></td>\
                        <td><select class="form-control form-select status" name="pagesection[' + i + '][status]" id="status_' + i + '">\
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
    function validatePageName() {
        var pageName = document.getElementById("page_name").value;
        var alphanumericRegex = /^[a-zA-Z ]+$/;
        var errorElement = document.getElementById("pageNameError");
        if (!alphanumericRegex.test(pageName)) {
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
            url: "{{ route('page.store') }}",
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
                        window.location.href = "{{ route('page.list') }}";
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