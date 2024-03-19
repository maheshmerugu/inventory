@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Manage Page Section </h4> <a href="{{('pagesection.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf
            <div class="card badge-light">
                <div class="card-body">
                    <div class=" ">
                        <div class="row">
                            <div class="col-lg-12 pb-4">
                                <h4 class=""> <b>Manage Page Section</b></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="role_name">Page Section Names <span class="text-danger">*</span></label>
                                    <input type="text" name="page_section_name" class="form-control form-control-lg" id="page_section_name" placeholder="Page Section Name" aria-label="Title" required oninput="validatePageSection()">
                                </div>
                                <div id="pageNameError" class="text-danger" style="display:none;">Page Section Name is required</div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control form-select" name="status" id="status">
                                        <option value="">- Select -</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="co-lg-12 text-center mt-4">
                                <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <a href="{{route('pagesection.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function validatePageSection() {
        var pageName = document.getElementById("page_section_name").value;
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
            url: "{{ route('pagesection.store') }}",
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
                        window.location.href = "{{ route('pagesection.list') }}";
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