@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Manage Role Page </h4> <a href="{{('rolepage.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                <label>Roles<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="role_id" id="role_id">
                                    <option value="">- Select Roles -</option>
                                    @foreach($all_roles as $status)
                                    <option value="{{ $status->id }}">{{ $status->role_name ?? ''}} </option>
                                    @endforeach
                                </select>
                                <span id="RolesError" class="text-danger" style="display: none;">Role is required.</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pages<span class="text-danger">*</span></label>
                                <div>
                                    @foreach($all_pages as $page)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pages[]" value="{{ $page->id }}" id="page{{ $page->id }}">
                                        <label class="form-check-label" for="page{{ $page->id }}">
                                            {{ $page->page_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <span id="PagesError" class="text-danger" style="display: none;">Pages are required.</span>
                            </div>
                        </div>

                        <div class="co-lg-12 text-center mt-4">
                            <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                            <button type="button" class="btn btn-gradient-success btn-fw ">
                                <a href="{{route('rolepage.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function validatePageName() {
        var pageName = document.getElementById("role_name").value;
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
            url: "{{ route('rolepage.store') }}",
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
                        window.location.href = "{{ route('rolepage.list') }}";
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