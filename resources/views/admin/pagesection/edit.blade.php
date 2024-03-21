@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Master </h4> <a href="{{('pagesection.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                <h4 class=""> <b>Edit Page Section</b></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="page_section_name">Page Section Name</label>
                                    <input type="text" name="page_section_name" class="form-control form-control-lg" id="page_section_name" placeholder="Page Section Name" value="{{$item->page_section_name}}" aria-label="Page Name">
                                </div>
                                <div id="pageNameError" class="text-danger" style="display:none;">Page Section Name is required</div>
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
                                <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <a href="{{ route('pagesection.list') }}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // function validatePageSection() {
    //     var pageName = document.getElementById("page_section_name").value;
    //     var alphanumericRegex = /^[a-zA-Z ]+$/; 
    //     var errorElement = document.getElementById("pageNameError");
    //     if (!alphanumericRegex.test(pageName)) {
    //         errorElement.style.display = "block";
    //     } else {
    //         errorElement.style.display = "none";
    //     }
    // }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);
        let itemId = "{{ $item->id }}";
        $.ajax({
            url: "{{ route('pagesection.update', ['id' => $item->id]) }}",
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