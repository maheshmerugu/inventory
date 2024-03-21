@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class="">Edit Role Page</h4>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <form id="role_page_form" method="POST" action="{{ route('rolepage.update', ['id' => $item->id]) }}">
            @csrf
            <div class="card badge-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Roles<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="role_id" id="role_id">
                                    <option value="">- Select Roles -</option>
                                    @foreach($all_roles as $role)
                                    <option value="{{ $role->id }}" {{ $item->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
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
                                        <input class="form-check-input" type="checkbox" name="pages[]" value="{{ $page->id }}" id="page{{ $page->id }}" {{ in_array($page->id, $selected_pages) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="page{{ $page->id }}">
                                            {{ $page->page_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <span id="PagesError" class="text-danger" style="display: none;">Pages are required.</span>
                            </div>
                        </div>
                    </div>
                    <div class="co-lg-12 text-center mt-4">
                        <button type="submit" id="role_page_form_btn" class="btn btn-info"><i class="mdi mdi-arrow-right-bold-hexagon-outline"></i> SUBMIT</button>
                        <a href="{{ route('rolepage.list') }}" class="btn btn-gradient-success btn-fw"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#role_page_form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let data = form.serialize();
            $.ajax({
                url: form.attr('action'),
                type: "POST",
                data: data,
                dataType: "JSON",
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
        });
    });
</script>
@endsection
