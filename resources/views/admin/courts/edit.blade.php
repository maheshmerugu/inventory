@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class=""> Court Edit Page </h4> <a href="{{route('courts.master.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="company_form" method="POST">
            @csrf

            <div class="card badge-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <h4 class=""> Courts </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="district_id" id="district_id">
                                    <option value="">- Select Status -</option>
                                    @foreach($all_districts as $district)
                                    <option value="{{ $district->id }}" @if($district->id == $item->district_id) selected @endif>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                <span id="DistrictNameError" class="text-danger" style="display: none;">District Name must be contain only Letters</span>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Court Name</label>
                                <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{$item->name}}" placeholder="Court Name" aria-label="CourtName">
                                <span id="CourtNameError" class="text-danger" style="display: none;">Court Name must contain only letters</span>
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
                                <a href="{{route('courts.master.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>

                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#company_form_btn").click(function(e) {
            e.preventDefault();
            let form = $('#company_form')[0];
            let data = new FormData(form);
            let itemId = "{{ $item->id }}"; // Replace this with the actual item ID if available

            $.ajax({
                url: "{{ route('courts.master.update', ['id' => $item->id]) }}", // Fix the URL here
                type: "POST",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.errors) {
                        var errorMsg = '';
                        // Construct error message
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
                            window.location.href = "{{ route('courts.master.list') }}";
                        }, 2000); // 2000 milliseconds = 2 seconds
                    }
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        message: 'An error occurred: ' + xhr.responseText,
                        position: 'topRight'
                    });
                }
            });
        });
    });
</script>


@endsection