@extends('layouts.al305_main')
@section('title', 'Create User Type')
@push('css')
    <link rel="stylesheet"
        href="{{ asset('alte305/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">User Types</h3>
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
            <a href="{{ url('user-type') }}">User Type</a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Create User Type</a>
        </li>
    </ul>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white" style="font-size: 13px">Create User Type</div>
                </div>
                <form action="{{ route('user-type.store') }}" method="POST" id="formSubmit">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email2">User Type Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required
                                placeholder="Enter Title">
                            <small id="titleError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email2">Select Role <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="roles" name="roles[]" multiple="multiple">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                            <small id="permissionsError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Active" id="active"
                                        checked>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Inactive"
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
                errorPlacement: function (error, element) {
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
                    var formData = new FormData(form);

                    // Convert select2 multiple selections to array
                    var permissions = $('#permissions').val();
                    if (permissions) {
                        formData.set('permissions', JSON.stringify(permissions));
                    }

                    $('#saveButton').prop("disabled", true);

                    // Clear previous errors
                    $('.text-danger').text('');

                    $.ajax({
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: "{{ route('user-type.store') }}",
                        success: function (res) {
                            if (res.success) {
                                swal({
                                    title: "Success!",
                                    text: res.message,
                                    icon: "success",
                                    position: "top-end",
                                    buttons: false,
                                    timer: 3000,
                                    customClass: {
                                        popup: 'swal2-custom-position'
                                    }
                                });

                                setTimeout(() => {
                                    window.location.href = "{{ url('/user-type') }}";
                                }, 1000);
                            } else {
                                $('#saveButton').prop("disabled", false);
                            }
                        },
                        error: function (xhr) {
                            $('#saveButton').prop("disabled", false);

                            if (xhr.status === 422) {
                                // Validation errors
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function (key, value) {
                                    if (key === 'title') {
                                        $('#titleError').text(value[0]);
                                    } else if (key === 'permissions' || key === 'permissions[]') {
                                        $('#permissionsError').text(value[0]);
                                    } else if (key === 'status') {
                                        $('#statusError').text(value[0]);
                                    }
                                });
                            } else {
                                // Other errors
                                swal({
                                    title: "Error!",
                                    text: "Something went wrong!",
                                    icon: "error",
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush