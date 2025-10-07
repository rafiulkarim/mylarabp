@extends('layouts.al305_main')
@section('title','Create Permission')
@push('css')
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">Permissions</h3>
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
            <a href="{{ url('permission') }}">Permissions</a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('permission/create') }}">Create Permission</a>
        </li>
    </ul>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white" style="font-size: 13px">Create Permission</div>
                </div>
                <form action="{{ route('permission.store') }}" method="POST" id="formSubmit">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email2">Permission Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                            <small id="titleError" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Active"
                                           id="active" checked>
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
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> Back</button>
                        <button class="btn btn-primary float-end" id="saveButton">Submit <i class="fa fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#formSubmit").validate({
                rules: {
                    title: {
                        required: true,
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    title: "Please enter permission title",
                    status: "Please select a status",
                },
                submitHandler: function (form) {
                    var data = $('#formSubmit').serialize();
                    if ($("#formSubmit").valid()) {
                        $('#saveButton').prop("disabled", true);
                        //Calling Ajax
                        $.ajax({
                            type: "POST",
                            data: data,
                            url: "{{ route('permission.store') }}",
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
                                        window.location.href = "{{ url('/permission') }}";
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
