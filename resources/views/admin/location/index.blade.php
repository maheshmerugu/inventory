@extends('layouts.app')

@section('content')

<style>
    .modal-content {
        top: 150px;
    }

 

</style>




    <div class="page-header">
        <h4 class="py-3"> LOCATION MASTER LIST </h4>
    </div>
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">


            <div class="card badge-light">
                <div class="card-body">

                    <form action="{{ route('vendor.masters.list') }}" method="GET">

                        <div class=" slider">
                            <div class="row">
                                <div class="col-sm-3 mb-1 mt-1">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder=" Search">
                                            <div class="input-group-append">
                                                <i class="mdi mdi-magnify"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-3 mb-1 mt-1">
                                    <div class="form-group">
                                        <select class="form-control form-select" name="status" id="status">
                                            <option value="">- Select Status -</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-2"><button id="searchBtn" type="submit" class="btn btn-success btn-fw"> <i class="mdi mdi-magnify"></i> Search</button></div>
                                <div class="col-sm-4  text-end mt-2">
                                    <a href="{{route('vendor.master')}}"><label class="badge badge-success"><i class="mdi  mdi-plus-circle-outline me-1"></i> Add</label></a>
                                    <label class="badge badge-info "><i class="mdi  mdi-check-circle-outline me-1"></i>Active</label>
                                    <label class="badge badge-warning"><i class="mdi mdi-close-circle-outline me-1"></i>In Active</label>
                                    <a href=""> <label class="badge badge-danger"><i class="mdi   mdi-delete me-1"></i> Delete</label></a>
                                    <a href=""> </a>


                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
            <div></div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card mt-3">

                <div class="table-responsive">
                    <div class="table-wrapper">
                        <table class="table table-striped ">
                            <thead class="table-dark">
                                <tr class="badge-secondary">
                                    <th><input type="checkbox" id="checkall"></th>
                                    <th>S.No</th>
                                    <th>Location Code</th>
                                    <th>Location Name</th>
                                    <th>Location Short Name</th>
                                    <th>District</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="CheckBoxClass" name="multiple[]" value="1">
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$item->location_code}}</td>
                                    <td>{{$item->location_name}}</td>
                                    <td>{{$item->location_short_name}}</td>
                                    <td>{{$item->district}}</td>
                                    <td>{{$item->address}}</td>


                                   
                                  
                                    <td>


                                        <label class="badge badge-info me-3">
                                            <i class="mdi mdi-reload btn-icon-prepend"><a href="{{ route('location.master.list.edit', $item->id) }}">update</a></i>
                                        </label>
                                        <label class="badge badge-danger">
                                            <!-- <i id="deleteButton" class="mdi mdi-delete me-1"></i> Delete -->

                                            <i type="button" class="mdi mdi-delete me-1 deleteButton" data-id="{{ $item->id }}">Delete</i>

                                        </label>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>



                        </table>
                        {{ $items->links() }}

                    </div>

                    


                </div>

            </div>



        </div>

    </div>

   


<!-- HTML for delete confirmation modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        // Show delete confirmation modal and get ID when delete button is clicked
        $(".deleteButton").click(function() {
            var itemId = $(this).data("id");
            $("#deleteConfirmationModal").modal("show");

            // Set the ID in the confirm delete button data attribute
            $("#confirmDelete").data("id", itemId);
        });

        // Handle delete confirmation
        $("#confirmDelete").click(function(e) {
            // Retrieve the ID from the confirm delete button data attribute
            var itemId = $(this).data("id");
            e.preventDefault();

            $.ajax({
                url: "{{ route('location.master.delete', ['id' => $item->id ?? '']) }}", // Adjust the route with item ID parameter
                type: "POST",
                data: {
                    _method: 'POST', // Specify the method as DELETE
                    _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                    id: itemId // Pass the item ID to be deleted
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            message: response.success,
                            position: 'topRight'
                        });
                        // Redirect to a specific URL after a successful delete
                        setTimeout(function() {
                            window.location.href = "{{ route('location.master.list') }}";
                        }, 2000); // 2000 milliseconds = 2 seconds
                    } else {
                        iziToast.error({
                            message: 'An error occurred: ' + response.error,
                            position: 'topRight'
                        });
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

        $("#confirmCancel").click(function(e) {
            // Retrieve the ID from the confirm delete button data attribute
            var itemId = $(this).data("id");
            e.preventDefault();
            $("#deleteConfirmationModal").modal("hide");



        });

        $("#close").click(function(e) {
            // Retrieve the ID from the confirm delete button data attribute
            var itemId = $(this).data("id");
            e.preventDefault();
            $("#deleteConfirmationModal").modal("hide");



        });
    });
</script>








@endsection