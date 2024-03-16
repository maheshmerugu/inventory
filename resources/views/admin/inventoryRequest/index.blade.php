<!-- @extends('layouts.app') -->

@section('content')

<style>
    .modal-content {
        top: 150px;
    }
</style>




<div class="page-header">
    <h4 class="py-3"> iNVENTORY REQUEST LIST
    </h4>
</div>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">


        <div class="card badge-light">
            <div class="card-body">

                <form action="{{ route('inventory.request.list') }}" method="GET">

                    <div class="slider">
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
                                <a href="{{route('inventory.request.create')}}"><label class="badge badge-success"><i class="mdi  mdi-plus-circle-outline me-1"></i> Add</label></a>
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
                                <th>S.no</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Requested By</th>
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
                                <td>{{$item->subject ?? ''}}</td>
                                <td>{{$item->message}}</td>

                                <td>
                                    <label class="badge badge-successs">
                                        <?php
                                        $statusText = '';

                                        if ($item->status !== null) {
                                            $statusText = $item->status == 1 ? 'Approved' : ($item->status == 0 ? 'Rejected' : '');
                                        }

                                        echo $statusText;
                                        ?>

                                    </label>
                                </td>
                                <td>{{$item->requestedName->name ?? ''}}</td>
                                <td>



                                    <label class="badge badge-success">
                                        <i class="mdi mdi-reload btn-icon-prepend" onclick="downloadPDF(<?php echo $item->id; ?>)">Download PDF</i>
                                    </label>


                                    @if($item->status == null)
                                    <label class="badge badge-info me-3">
                                        <i type="button" class="mdi mdi-reload btn-icon-prepend approveButton" data-id="{{ $item->id ?? '' }}">Approve</i>
                                    </label>
                                    <label class="badge badge-danger">
                                        <i type="button" class="mdi mdi-delete me-1 rejectButton" data-id="{{ $item->id ?? '' }}">Reject</i>
                                    </label>
                                    @endif
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
                url: "{{ route('inventory.request.delete', ['id' => $item->id ?? '']) }}", // Adjust the route with item ID parameter
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
                            window.location.href = "{{ route('inventory.request.list') }}";
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


<script>
    $(".approveButton").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);
        let itemId = "{{ $item->id  ?? ''}}"; // Assuming you have the item ID available
        let status = "approved"; // Change this to the desired status value

        // Get the CSRF token value from the meta tag
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Add CSRF token and status to the FormData object
        data.append('_token', csrfToken);
        data.append('status', status);

        $.ajax({
            url: "{{ route('inventory.request.statuschange', ['id' => $item->id ?? '']) }}", // Adjust the route with item ID parameter
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
                        window.location.href = "{{ route('inventory.request.list') }}";
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



<script>
    $(".rejectButton").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);
        let itemId = "{{ $item->id  ?? ''}}"; // Assuming you have the item ID available
        let status = "rejected"; // Change this to the desired status value

        // Get the CSRF token value from the meta tag
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Add CSRF token and status to the FormData object
        data.append('_token', csrfToken);
        data.append('status', status);

        $.ajax({
            url: "{{ route('inventory.request.statuschange', ['id' => $item->id ?? '']) }}", // Adjust the route with item ID parameter
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
                        window.location.href = "{{ route('inventory.request.list') }}";
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>




<script>
    function generatePDF(subject, message) {
        const doc = new jsPDF();
        doc.text(20, 20, 'Subject: ' + subject);
        doc.text(20, 30, 'Message: ' + message);
        doc.save('message.pdf');
    }
</script>

<script>
    function downloadPDF(itemId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/inventory/inventory-request-download?id=' + itemId, true);
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (this.status === 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'document.pdf';
                link.click();
            }
        };

        xhr.send();
    }
</script>







@endsection