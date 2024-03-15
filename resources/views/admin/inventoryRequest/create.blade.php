@extends('layouts.app')

@section('content')
   <div class="page-header">
        <h4 class=""> Master </h4> <a href="{{('item-groups-masters-list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
    </div>
    <div class="content-wrapper">
        <div class="col-12 grid-margin stretch-card">
            <div class="card badge-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 pb-4">
                            <h4 class="mb-4">Inventory Request Form</h4>
                        </div>
                        <div class="col-lg-12">
                            <form id="contact_form" action="/send-message" method="POST">
                                @csrf <!-- CSRF protection for Laravel -->
                                <div class="form-group">
                                    <label for="subject">Subject:</label>
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea id="message" name="message" rows="3"  class="form-control" required></textarea>
                                </div>
                                <div class="co-lg-12 text-center mt-4">
                                <button type="button" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i>
                                    SUBMIT</button>
                                <button type="button" class="btn btn-gradient-success btn-fw">
                                    <i class="mdi mdi-arrow-left-bold-circle"></i> BACK</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    function validateGroupCode() {
        var groupCode = document.getElementById("group_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("groupCodeError");
        if (!alphanumericRegex.test(groupCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function validateGroupName() {
        var groupName = document.getElementById("group_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("groupNameError");
        if (!alphanumericRegex.test(groupName)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }



    function validateShortName() {
        var groupName = document.getElementById("group_short_name").value;
        var alphanumericRegex = /^[a-zA-Z]+$/;
        var errorElement = document.getElementById("groupShortNameError");
        if (!alphanumericRegex.test(groupName)) {
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
            url: "{{ route('itemgroup.store') }}",
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
                        window.location.href = "{{ route('itemgroup.index') }}";
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