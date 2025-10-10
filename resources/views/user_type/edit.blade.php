@extends('layouts.al305_main')
@section('title', 'Update User Type')
@push('css')
    <link rel="stylesheet"
        href="{{ asset('alte305/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">User Type</h3>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{ url('/home') }}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('user-type') }}">User Types</a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Update User Type</a>
        </li>
    </ul>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white" style="font-size: 13px">Update User Type</div>
                </div>
                <form id="formSubmit">
                    @csrf
                    <input type="hidden" value="{{ $userType->id }}" name="id" id="user-type-id" >
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email2">User Type Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required
                                value="{{ $userType->title }}" placeholder="Enter Title">
                            <small id="titleError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email2">Select Roles <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="roles" name="roles[]" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array( $role->id, $roleData) ? 'selected' : '' }}
                                        >{{ $role->title }}</option>
                                @endforeach
                            </select>
                            <small id="permissionsError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Active" id="active"
                                        {{ $userType->status == "Active" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Inactive"
                                    {{ $userType->status == "Inactive" ? 'checked' : '' }}
                                        id="inactive">
                                    <label class="form-check-label" for="inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                            <small id="statusError" class="form-text text-danger"></small>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="button" class="btn btn-outline-primary" onclick="window.history.back()"><i
                                class="fa fa-arrow-left"></i> Back</button>
                        <button type="submit" class="btn btn-primary float-end" id="saveButton">Submit <i
                                class="fa fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{!! asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')!!}"></script>
    <script src="{!! asset('plugins/select2/js/select2.full.min.js')!!}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#formSubmit").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    'permissions[]': {
                        required: true,
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    title: "Please enter role title",
                    'permissions[]': "Please select at least one permission",
                    status: "Please select a status",
                },
                errorPlacement: function(error, element) {
                    // Custom error placement for specific fields
                    if (element.attr("name") == "title") {
                        error.appendTo("#titleError");
                    } else if (element.attr("name") == "permissions[]") {
                        error.appendTo("#permissionsError");
                    } else if (element.attr("name") == "status") {
                        error.appendTo("#statusError");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    var id = $('#user-type-id').val()
                    var data = $('#formSubmit').serialize();
                    console.log(data)
                    // console.log(id)
                    if ($("#formSubmit").valid()) {
                        $('#saveButton').prop("disabled", true);
                        //Calling Ajax
                        $.ajax({
                            type: "PUT",
                            data: data,
                            url: "{{ url('user-type/update') }}",
                            success: function (res) {
                                if (parseInt(res.success) == 1) {
                                    swal({
                                        title: "Success!",
                                        text: res.message,
                                        icon: "success",
                                        position: "top-end", // positions the alert at the top-right
                                        buttons: false, // hides buttons if you want it to be non-interactive
                                        timer: 3000, // auto close after 3 seconds
                                        customClass: {
                                            popup: 'swal2-custom-position'
                                        }
                                    });

                                    setTimeout(() => {
                                        window.location.href = "{{ url('/user-type') }}";
                                    }, 1000);
                                } else {
                                    $('#submit').prop("disabled", false);
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush