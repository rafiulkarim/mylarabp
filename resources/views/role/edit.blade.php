@extends('layouts.al305_main')
@section('title', 'Update Role')
@push('css')
    <link rel="stylesheet"
        href="{{ asset('alte305/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">Roles</h3>
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
            <a href="{{ url('role') }}">Roles</a>
        </li>
        {{-- <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('role/create') }}">Update Role</a>
        </li> --}}
    </ul>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white" style="font-size: 13px">Update Role</div>
                </div>
                <form id="formSubmit">
                    @csrf
                    <input type="hidden" value="{{ $role->id }}" name="id" id="role-id" >
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email2">Role Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required
                                value="{{ $role->title }}" placeholder="Enter Title">
                            <small id="titleError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="email2">Select Permissions <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="permissions" name="permissions[]" multiple="multiple">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ in_array( $permission->id, $permissionData) ? 'selected' : '' }}
                                        >{{ $permission->title }}</option>
                                @endforeach
                            </select>
                            <small id="permissionsError" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Active" id="active"
                                        {{ $role->status == "Active" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Inactive"
                                    {{ $role->status == "Inactive" ? 'checked' : '' }}
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
                    var id = $('#role-id').val()
                    var data = $('#formSubmit').serialize();
                    console.log(data)
                    // console.log(id)
                    if ($("#formSubmit").valid()) {
                        $('#saveButton').prop("disabled", true);
                        //Calling Ajax
                        $.ajax({
                            type: "PUT",
                            data: data,
                            url: "{{ url('role/update') }}",
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
                                        window.location.href = "{{ url('/role') }}";
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