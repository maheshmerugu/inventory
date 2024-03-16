@extends('layouts.app')

@section('content')
   <div class="page-header">
        <h4 class=""> Master </h4> <a href="{{route('inventory.request.list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                        <form id="company_form" method="POST">
                            @csrf                               
                                <div class="form-group">
                                    <label for="subject">Subject:</label>
                                    <input type="text" id="subject" name="subject" class="form-control" oninput="validateSubject()" required>

                                    <span id="subjectError" class="text-danger" style="display: none;">Subject Must be letters only </span>

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
    function validateSubject() {
        var groupCode = document.getElementById("subject").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/;
        var errorElement = document.getElementById("subjectError");
        if (!alphanumericRegex.test(groupCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }


    function validateMessage() {
        var groupName = document.getElementById("message").value;
        var alphanumericRegex = /^[a-zA-Z\s]+$/;
        var errorElement = document.getElementById("messageError");
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<script>
    $("#company_form_btn").click(function(e) {
        e.preventDefault();
        let form = $('#company_form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ route('inventory.request.store') }}",
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
    function downloadPDF() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/generate-pdf', true);
    xhr.responseType = 'blob';

    xhr.onload = function () {
        if (this.status === 200) {
            var blob = new Blob([this.response], { type: 'application/pdf' });
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