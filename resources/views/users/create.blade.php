@extends('layouts.al305_main')
@section('title', 'Create User')
@push('css')
    <link rel="stylesheet"
        href="{{ asset('alte305/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .input-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon .input-icon-addon {
            position: absolute;
            left: 10px;
            color: #6c757d;
        }

        .input-icon input.form-control {
            padding-left: 35px;
        }

        .form-text.text-danger {
            margin-top: 2px;
            font-size: 12px;
        }
    </style>
@endpush

@section('breadcrumb')
    <h3 class="fw-bold">Users</h3>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('user') }}">Users</a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/create') }}">Create User</a>
        </li>
    </ul>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-white" style="font-size: 13px">Create User</div>
                </div>
                <form id="userForm" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Full Name --}}
                        <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name"
                                    required>
                            </div>
                            <small id="nameError" class="form-text text-danger"></small>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <small id="emailError" class="form-text text-danger"></small>
                        </div>

                        {{-- Mobile --}}
                        <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" name="cell_phone" id="cell_phone" pattern="01[3-9][0-9]{8}"
                                    class="form-control" placeholder="Enter Mobile Number">
                            </div>
                            <small id="cell_phoneError" class="form-text text-danger"></small>
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password" required>
                            </div>
                            <small id="passwordError" class="form-text text-danger"></small>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Enter Confirm Password" required>
                            </div>
                            <small id="passwordConfirmationError" class="form-text text-danger"></small>
                        </div>

                        {{-- User Type --}}
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-select select2" name="user_type" id="user_type" required>
                                <option value="">Select User Type</option>
                                @foreach ($userTypes as $userType)
                                    <option value="{{ $userType->id }}">{{ $userType->title }}</option>
                                @endforeach
                            </select>
                            <small id="userTypeError" class="form-text text-danger"></small>
                        </div>

                        {{-- Gender --}}
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" id="gender_male"
                                        checked>
                                    <label class="form-check-label" for="gender_male">Male</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" value="Female"
                                        id="gender_female">
                                    <label class="form-check-label" for="gender_female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Others"
                                        id="gender_others">
                                    <label class="form-check-label" for="gender_others">Others</label>
                                </div>
                            </div>
                            <small id="genderError" class="form-text text-danger"></small>
                        </div>

                        {{-- Web Access --}}
                        <div class="form-group">
                            <label>Web Access</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="web_access" value="1"
                                        id="web_access_yes" checked>
                                    <label class="form-check-label" for="web_access_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="web_access" value="0"
                                        id="web_access_no">
                                    <label class="form-check-label" for="web_access_no">No</label>
                                </div>
                            </div>
                            <small id="webAccessError" class="form-text text-danger"></small>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="card-action">
                        <button type="button" class="btn btn-danger" onclick="window.history.back()">
                            <i class="fa fa-arrow-left"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-success float-end" id="saveButton">
                            Submit <i class="fa fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });

        // Add custom method for select2 validation
        $.validator.addMethod("select2Required", function (value, element) {
            return $(element).val() !== "" && $(element).val() !== null;
        }, "Please select a valid option");

        // Custom validation for at least one contact method
        $.validator.addMethod("atLeastOneContact", function (value, element) {
            var email = $('#email').val();
            var cell_phone = $('#cell_phone').val();
            return email !== '' || cell_phone !== '';
        }, "Please provide either email or mobile number");

        $(document).ready(function () {
            $("#userForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    email: {
                        email: true,
                        atLeastOneContact: true
                    },
                    cell_phone: {
                        pattern: /^01[3-9][0-9]{8}$/,
                        atLeastOneContact: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    user_type: {
                        required: true,
                        select2Required: true
                    },
                    gender: {
                        required: true
                    },
                    web_access: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter full name",
                        minlength: "Name must be at least 2 characters long",
                        maxlength: "Name cannot exceed 100 characters"
                    },
                    email: {
                        email: "Please enter a valid email address"
                    },
                    cell_phone: {
                        pattern: "Please enter a valid Bangladeshi mobile number (e.g., 01712345678)"
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Password must be at least 6 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    user_type: {
                        required: "Please select user type",
                        select2Required: "Please select user type"
                    },
                    gender: {
                        required: "Please select gender"
                    },
                    web_access: {
                        required: "Please select web access option"
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "name") {
                        error.appendTo("#nameError");
                    } else if (element.attr("name") == "email") {
                        error.appendTo("#emailError");
                    } else if (element.attr("name") == "cell_phone") {
                        error.appendTo("#cell_phoneError");
                    } else if (element.attr("name") == "password") {
                        error.appendTo("#passwordError");
                    } else if (element.attr("name") == "password_confirmation") {
                        error.appendTo("#passwordConfirmationError");
                    } else if (element.attr("name") == "user_type") {
                        error.appendTo("#userTypeError");
                    } else if (element.attr("name") == "gender") {
                        error.appendTo("#genderError");
                    } else if (element.attr("name") == "web_access") {
                        error.appendTo("#webAccessError");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    var formData = new FormData(form);

                    $('#saveButton').prop("disabled", true)
                        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');

                    $('.text-danger').text('');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            // Handle both response formats for compatibility
                            var success = res.success === true || res.success === 1;
                            var message = res.message || 'Operation completed';

                            if (success) {
                                swal({
                                    title: "Success!",
                                    text: message,
                                    icon: "success",
                                    buttons: false,
                                    timer: 3000
                                });
                                setTimeout(() => {
                                    window.location.href = "{{ url('/user') }}";
                                }, 1000);
                            } else {
                                $('#saveButton').prop("disabled", false)
                                    .html('Submit <i class="fa fa-save"></i>');
                                swal({
                                    title: "Error!",
                                    text: message || "Something went wrong!",
                                    icon: "error",
                                });
                            }
                        },
                        error: function (xhr) {
                            $('#saveButton').prop("disabled", false)
                                .html('Submit <i class="fa fa-save"></i>');

                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;

                                // Map backend error keys to frontend element IDs
                                var errorMapping = {
                                    'name': 'nameError',
                                    'email': 'emailError',
                                    'cell_phone': 'cell_phoneError',
                                    'password': 'passwordError',
                                    'user_type': 'userTypeError',
                                    'gender': 'genderError',
                                    'web_access': 'webAccessError'
                                };

                                $.each(errors, function (key, value) {
                                    var elementId = errorMapping[key];
                                    if (elementId) {
                                        $('#' + elementId).text(value[0]);
                                    }
                                });

                                // Show a general error toast
                                swal({
                                    title: "Validation Error!",
                                    text: "Please check the form and correct the errors.",
                                    icon: "error",
                                    timer: 3000
                                });
                            } else {
                                swal({
                                    title: "Error!",
                                    text: "Something went wrong! Please try again.",
                                    icon: "error",
                                });
                            }
                        }
                    });

                    return false; // Prevent default form submission
                }
            });

            // Trigger validation on select2 change
            $('#user_type').on('change', function () {
                $(this).valid();
            });

            // Real-time validation for mobile
            $('#cell_phone').on('input', function () {
                var cell_phone = $(this).val();
                var pattern = /^01[3-9][0-9]{8}$/;
                $('#cell_phoneError').text(
                    cell_phone && !pattern.test(cell_phone)
                        ? 'Please enter a valid Bangladeshi mobile number (e.g., 01712345678)'
                        : ''
                );
            });

            // Real-time validation for password confirmation
            $('#password, #password_confirmation').on('input', function () {
                var password = $('#password').val();
                var confirmPassword = $('#password_confirmation').val();
                if (confirmPassword) {
                    $('#passwordConfirmationError').text(
                        password !== confirmPassword
                            ? 'Passwords do not match'
                            : ''
                    );
                }
            });

            // Validate at least one contact method
            $('#email, #cell_phone').on('input', function () {
                var email = $('#email').val();
                var cell_phone = $('#cell_phone').val();

                if (email === '' && cell_phone === '') {
                    $('#emailError').text('Please provide either email or mobile number');
                    $('#cell_phoneError').text('Please provide either email or mobile number');
                } else {
                    $('#emailError').text('');
                    $('#cell_phoneError').text('');
                }
            });
        });
    
    </script>
@endpush