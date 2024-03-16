@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="page-header">
        <h4 class=""> Master </h4> <a href="{{('item-masters-list')}}" class=" "> <label class="badge badge-info"><i class="mdi mdi-apps"></i> Manage</label></a>
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
                                    <h4 class=""> <b>Item Master</b></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="group_name">Group</label>
                                        <select class="form-control form-select" name="group_name" id="group_name" onchange="validateGroupCode()">
                                            <option value="0">- Select Group -</option>
                                            <option value="1">Article</option>
                                            <option value="2">Video</option>
                                            <option value="3">Interview QA</option>
                                        </select>
                                        <div id="groupError" class="text-danger" style="display:none;">Group is required</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="item_code">Item Code <span class="text-danger">*</span></label>
                                        <input type="text" name="item_code" class="form-control form-control-lg" id="item_code" placeholder="Item Code" aria-label="Title" required oninput="validateItemCode()">
                                    </div>
                                    <div id="itemCodeError" class="text-danger" style="display:none;">Item Code is required</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="item_name">Item Name</label>
                                        <input type="text" name="item_name" class="form-control form-control-lg" id="item_name" placeholder="Enter item" aria-label="KnowMore Url" required oninput="validateItemName()">
                                    </div>
                                    <div id="itemNameError" class="text-danger" style="display:none;">Item Name is required</div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label for="pn">PN/ (Y/N)</label>
                                        <select class="form-control form-select" name="pn" id="pn" onchange="validatePnSelection()">
                                            <option value="0">- Select PN/ (Y/N) -</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            <option value="3">Interview QA</option>
                                        </select>
                                    </div>
                                    <div id="pnError" class="text-danger" style="display:none;">PN/ (Y/N) selection is required</div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label for="critical">Critical (C/NC)</label>
                                        <select class="form-control form-select" name="critical" id="critical" onchange="validateCriticalSelection()">
                                            <option value="0">- Select Critical -</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            <option value="3">Interview QA</option>
                                        </select>
                                    </div>
                                    <div id="criticalError" class="text-danger" style="display:none;">Critical selection is required</div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label for="active">Active</label>
                                        <select class="form-control form-select" name="status" id="active">
                                            <option value="">- Select -</option>
                                            <option value="0">In Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                    <div id="activeError" class="text-danger" style="display:none;">Active selection is required</div>
                                </div>
                                <div class="co-lg-12 text-center mt-4">
                                    <button type="submit" id="company_form_btn" class="btn btn-info "><i class="mdi mdi-arrow-right-bold-hexagon-outline "></i> SUBMIT</button>
                                    <button type="button" class="btn btn-gradient-success btn-fw ">
                                    <a href="{{route('item.masters.list')}}"><i class="mdi mdi-arrow-left-bold-circle"></i> BACK</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function validateGroupCode() {
        var groupName = document.getElementById("group_name");
        var selectedValue = groupName.options[groupName.selectedIndex].value;
        var errorElement = document.getElementById("groupError");

        if (selectedValue === "0") {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }
    function validateItemCode() {
        var itemCode = document.getElementById("item_code").value;
        var alphanumericRegex = /^[a-zA-Z0-9]+$/;
        var errorElement = document.getElementById("itemCodeError");
        if (!alphanumericRegex.test(itemCode)) {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }

    function validateItemName() {
        var itemName = document.getElementById("item_name").value;
        var errorElement = document.getElementById("itemNameError");
        if (itemName.trim() === "") {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }

    function validatePnSelection() {
        var pnValue = document.getElementById("pn").value;
        var errorElement = document.getElementById("pnError");
        if (pnValue === "0") {
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    }

    function validateCriticalSelection() {
        var criticalValue = document.getElementById("critical").value;
        var errorElement = document.getElementById("criticalError");
        if (criticalValue === "0") {
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
            url: "{{ route('itemmaster.store') }}",
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
                        window.location.href = "{{ route('item-masters-list') }}";
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