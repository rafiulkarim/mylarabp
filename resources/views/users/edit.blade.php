@extends('layouts.al305_main')
@section('title', 'Users')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('alte305/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">--}}
    <link href="{!! asset('supporting/bootstrap-fileinput/bootstrap-fileinput.css')!!}" rel="stylesheet" type="text/css" />
    <style>
        /* Ultra-compact datetime picker styling */
        .bootstrap-datetimepicker-widget {
            font-size: 11px !important;
            padding: 3px !important;
            min-width: 140px !important;
            max-width: 160px !important;
        }

        .bootstrap-datetimepicker-widget table {
            font-size: 11px !important;
            margin: 0 !important;
        }

        .bootstrap-datetimepicker-widget table th,
        .bootstrap-datetimepicker-widget table td {
            padding: 2px 4px !important;
            height: 22px !important;
            line-height: 18px !important;
            width: 22px !important;
            min-width: 22px !important;
        }

        .bootstrap-datetimepicker-widget table th {
            font-weight: 600;
            font-size: 10px !important;
        }

        .bootstrap-datetimepicker-widget .datepicker-days table td.day {
            width: 22px !important;
            height: 22px !important;
            font-size: 10px !important;
        }

        .bootstrap-datetimepicker-widget .picker-switch {
            padding: 2px !important;
            font-size: 11px !important;
        }

        .bootstrap-datetimepicker-widget .timepicker-hour,
        .bootstrap-datetimepicker-widget .timepicker-minute,
        .bootstrap-datetimepicker-widget .timepicker-second {
            height: 22px !important;
            font-size: 11px !important;
            width: 40px !important;
        }

        .bootstrap-datetimepicker-widget .timepicker-picker table td {
            padding: 0 2px !important;
        }

        .bootstrap-datetimepicker-widget .timepicker-picker .btn {
            padding: 2px 4px !important;
            font-size: 10px !important;
        }

        /* Reduce the size of the dropdown */
        .bootstrap-datetimepicker-widget.dropdown-menu {
            min-width: 140px !important;
            max-width: 160px !important;
        }

        /* Compact header */
        .bootstrap-datetimepicker-widget .datepicker-months table,
        .bootstrap-datetimepicker-widget .datepicker-years table,
        .bootstrap-datetimepicker-widget .datepicker-decades table {
            margin: 0 !important;
        }

        .bootstrap-datetimepicker-widget .datepicker-months table td,
        .bootstrap-datetimepicker-widget .datepicker-years table td,
        .bootstrap-datetimepicker-widget .datepicker-decades table td {
            padding: 4px 6px !important;
            font-size: 11px !important;
        }

        /* Make the input group more compact too */
        /* .input-group.date {
                    max-width: 300px;
                } */

        /* .input-group.date .form-control {
                    font-size: 12px;
                    padding: 4px 8px;
                    height: 30px;
                }

                .input-group-text {
                    padding: 4px 8px;
                    font-size: 12px;
                    height: 30px;
                } */
    </style>
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">Users</h3>
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
            <a href="{{ url('user') }}">Users</a>
        </li>
        <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">User Details</a>
        </li>
    </ul>
@endsection

@section('maincontent')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-round">
                <div class="card-body">
                    <div class="text-center">
                        @if ($user->imageprofile->image != 'default_image.png')
                            <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                src="{{ asset('storage/images/' . $user->imageprofile->image) }}" alt="profile">
                        @elseif($user->profile->gender == "Male")
                            <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                src="{{ asset('storage/images/default_image_male.png') }}" alt="profile">
                        @elseif($user->profile->gender == "Female")
                            <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                src="{{ asset('storage/images/default_image_female.png') }}" alt="profile">
                        @endif
                        <h5 class="mt-2">{{ $user->name }}</h5>
                        <h6 class="badge badge-success">{{ isset($user->user_type) ? $user->user_type->title : '' }}</h6>
                    </div>
                </div>
            </div>
            <div class="card card-round">
                <div class="card-header card-primary">
                    About
                </div>
                <div class="card-body">
                    <span><i class="fas fa-user-circle"></i></span><span class="m-2 text-decoration-underline fw-bold">User
                        Info</span> <br>
                    <div class="ms-4">
                        <strong>Email:</strong> {{ $user->email ?? 'N/A' }} <br>
                        <strong>Phone:</strong> {{ $user->cell_phone ?? 'N/A' }} <br>
                        <strong>Status:</strong> {{ $user->status ?? 'N/A' }} <br>
                    </div>
                    <hr>
                    <span><i class="fas fa-map-marker-alt"></i></span><span
                        class="m-2 text-decoration-underline fw-bold">Address
                        Info</span> <br>
                    <div class="ms-4">
                        <strong>Address 1:</strong> {{ isset($user->profile) ? $user->profile->address : 'N/A' }} <br>
                        <strong>Address 2:</strong> {{ isset($user->profile) ? $user->profile->address : 'N/A' }} <br>
                    </div>
                    <hr>
                    <span><i class="fas fa-phone-volume"></i></span><span
                        class="m-2 text-decoration-underline fw-bold">Contact
                        Info</span> <br>
                    <div class="ms-4">
                        <strong>Contact 1:</strong> {{ isset($user->profile) ? $user->profile->contact_no1 : 'N/A' }} <br>
                        <strong>Contact 2:</strong> {{ isset($user->profile) ? $user->profile->contact_no2 : 'N/A' }} <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
                        <li class="nav-item submenu" role="presentation">
                            <a class="nav-link active" id="line-home-tab" data-bs-toggle="pill" href="#profile" role="tab"
                                aria-controls="pills-home" aria-selected="false" tabindex="-1"><i
                                    class="fas fa-user-circle me-2"></i>Profile</a>
                        </li>
                        <li class="nav-item submenu" role="presentation">
                            <a class="nav-link" id="line-profile-tab" data-bs-toggle="pill" href="#roleAndAccess" role="tab"
                                aria-controls="pills-profile" aria-selected="false" tabindex="-1"><i
                                    class="fas fa-user-tie me-2"></i>Avatar</a>
                        </li>
                        <li class="nav-item submenu" role="presentation">
                            <a class="nav-link" id="line-profile-tab" data-bs-toggle="pill" href="#settings" role="tab"
                                aria-controls="pills-profile" aria-selected="false" tabindex="-1"><i
                                    class="fas fa-user-cog me-2"></i>Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3 mb-3" id="line-tabContent">
                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="line-home-tab">
                            <form action="{{ url('profile') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $user->profile->id }}" name="profile_id">
                                <div class="form-group row">
                                    <label for="name" style="text-align: right" class="col-md-3 required-field"><strong>Full
                                            Name</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                                value="{{ $user->name }}" placeholder="Enter Full Name" required>
                                        </div>
                                        <small id="nameError" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" style="text-align: right" class="col-md-3 required-field"><strong>Phone Number</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="cell_phone" id="cell_phone" class="form-control form-control-sm"
                                                value="{{ $user->cell_phone }}" placeholder="Enter Phone Number">
                                        </div>
                                        <small id="cell_phoneError" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="input-icon">
                                    <div class="form-group row">
                                        <label for="name" style="text-align: right"
                                            class="col-md-3 required-field"><strong>Joining Date</strong> :</label>
                                        <div class="col-md-7">
                                            <div class="input-group date compact-datepicker" id="joining_date"
                                                data-target-input="nearest">
                                                <input type="text" name="joining_date"
                                                    class="form-control form-control-sm datetimepicker-input" required
                                                    value="{{ \Carbon\Carbon::parse($user->profile->joining_date)->format('d-m-Y') }}"
                                                    data-target="#joining_date" placeholder="Select Joining Date" />
                                                <div class="input-group-prepend" data-target="#joining_date"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" style="text-align: right" class="col-md-3 required-field"><strong>Date
                                            of Birth</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group date compact-datepicker" id="date_of_birth"
                                            data-target-input="nearest">
                                            <input type="text" name="date_of_birth"
                                                class="form-control form-control-sm datetimepicker-input"
                                                value="{{ ($user->profile->date_of_birth != null) ? Carbon\Carbon::parse($user->profile->date_of_birth)->format('d-m-Y') : '' }}"
                                                data-target="#date_of_birth" placeholder="Select Date of Birth" />
                                            <div class="input-group-prepend" data-target="#date_of_birth"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" style="text-align: right"
                                        class="col-md-3 required-field"><strong>Gender</strong> :</label>
                                    <div class="col-md-8">
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender" value="Male"
                                                    id="gender_male" {{ $user->profile->gender == 'Male' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender_male">Male</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender" value="Female"
                                                {{ $user->profile->gender == 'Female' ? 'checked' : '' }}
                                                    id="gender_female">
                                                <label class="form-check-label" for="gender_female">Female</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="Others"
                                                {{ $user->profile->gender == 'Others' ? 'checked' : '' }}
                                                    id="gender_others">
                                                <label class="form-check-label" for="gender_others">Others</label>
                                            </div>
                                        </div>
                                    </div>
                                    <small id="genderError" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group row">
                                    <label for="nid" style="text-align: right" class="col-md-3 required-field"><strong>NID No(Unique)</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="nid" id="nid" class="form-control form-control-sm"
                                                value="{{ $user->profile->nid }}" placeholder="Enter NID Number" >
                                        </div>
                                        <small id="nidError" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contact_no1" style="text-align: right" class="col-md-3 required-field"><strong>Contact No 1</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="contact_no1" id="contact_no1" class="form-control form-control-sm"
                                                value="{{ $user->profile->contact_no1 }}" placeholder="Enter Contact Number 1" >
                                        </div>
                                        <small id="contact_no1Error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contact_no2" style="text-align: right" class="col-md-3 required-field"><strong>Contact No 2</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="contact_no2" id="contact_no2" class="form-control form-control-sm"
                                                value="{{ $user->profile->contact_no2 }}" placeholder="Enter Contact Number 2" >
                                        </div>
                                        <small id="contact_no2Error" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" style="text-align: right" class="col-md-3 required-field"><strong>Address</strong> :</label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <input type="text" name="address" id="address" class="form-control form-control-sm"
                                                value="{{ $user->profile->address }}" placeholder="Enter Address" >
                                        </div>
                                        <small id="addressError" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="button" class="btn btn-danger" onclick="window.history.back()">
                                        <i class="fa fa-arrow-left"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success float-end" id="saveButton">
                                        Update <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="roleAndAccess" role="tabpanel" aria-labelledby="line-profile-tab">
                            <div class="card-body">
                                <form action="{{ url('profile_image') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                    <input type="hidden" value="{{ $user->id }}" name="profile_image_id">
                                    <div class="form-group">
                                        <h3>Profile Picture</h3>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail"
                                                    style="width: 200px; height: 150px;">
                                                @if ($user->imageprofile->image != 'default_image.png')
                                                    <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                                        src="{{ asset('storage/images/' . $user->imageprofile->image) }}" alt="profile">
                                                @elseif($user->profile->gender == "Male")
                                                    <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                                        src="{{ asset('storage/images/default_image_male.png') }}" alt="profile">
                                                @elseif($user->profile->gender == "Female")
                                                    <img class="rounded-circle img-fluid avatar-img" style="width: 150px; height: 150px;"
                                                        src="{{ asset('storage/images/default_image_female.png') }}" alt="profile">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"
                                                    style="max-width: 200px; max-height: 200px;"></div>
                                            <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new"> Select Avatar </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="profile_image" accept="image/*">
                                            </span>
                                                <a href="javascript:;" class="btn btn-default fileinput-exists"
                                                    data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="callout callout-warning">
                                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                            <p>
                                                <span style="font-size: 12px"> Prefered image size for Avatar is 300X300 & not more then 1MB. Supported image type should be jpeg, jpj, png and bmp. Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="button" class="btn btn-danger" onclick="window.history.back()">
                                            <i class="fa fa-arrow-left"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-success float-end" id="saveButton">
                                            Update <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="line-profile-tab">
                            <div class="card-body">
                                <form action="{{ url('profile-settings') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    <div class="form-group row">
                                        <label for="password" style="text-align: right" class="col-md-3 required-field"><strong>Passwrod</strong> :</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <input type="password" name="password" required id="password" class="form-control form-control-sm"
                                                    placeholder="Enter Passwrod" >
                                            </div>
                                            <small id="passwordError" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" style="text-align: right" class="col-md-3 required-field"><strong>Confirm Passwrod</strong> :</label>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <input type="password" name="confirm_password" required id="confirm_password" class="form-control form-control-sm"
                                                    placeholder="Enter Confirm Passwrod" >
                                            </div>
                                            <small id="confirm_password_error" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" style="text-align: right" class="col-md-3 required-field"><strong>User Type</strong> :</label>
                                        <div class="col-md-7">
                                        <select class="form-select select2" name="user_type" id="user_type" 
                                        style="width: 100%" required>
                                            <option value="">Select User Type</option>
                                            @foreach ($userTypes as $userType)
                                                <option value="{{ $userType->id }}"
                                                    @if ($user->user_type_id == $userType->id)
                                                    selected
                                                    @endif>{{ $userType->title }}</option>
                                            @endforeach
                                        </select>
                                        <small id="userTypeError" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="web_access" style="text-align: right" class="col-md-3 required-field"><strong>Web Access</strong> :</label>
                                        <div class="col-md-7">
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="web_access" value="1"
                                                    id="web_access_yes" {{ $user->web_access == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="web_access_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="web_access" value="0" {{ $user->web_access == 0 ? 'checked' : '' }}
                                                    id="web_access_no">
                                                <label class="form-check-label" for="web_access_no">No</label>
                                            </div>
                                        </div>
                                        <small id="webAccessError" class="form-text text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="button" class="btn btn-danger" onclick="window.history.back()">
                                            <i class="fa fa-arrow-left"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-success float-end" id="saveButton">
                                            Update <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{!! asset('plugins/moment/moment.min.js')!!}"></script>
    <script src="{!! asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')!!}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{!! asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')!!}"></script>

    <script src="{!! asset('plugins/select2/js/select2.full.min.js')!!}"></script>
    <script src="{!! asset('supporting/bootstrap-fileinput/bootstrap-fileinput.js') !!}" type="text/javascript"></script>
    <script>
        $(function () {
            $('.select2').select2();
        });

        $(document).ready(function() {
            $('.fileinput').fileinput(); // ensure initialization
        });
    </script>


    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })

            // Ultra-compact datetime picker configuration
            var compactOptions = {
                format: 'DD-MM-YYYY',
                useCurrent: false,
                icons: {
                    time: 'fa fa-clock',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-calendar-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                },
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'bottom'
                },
                keepOpen: false,
                inline: false,
                // Additional compact options
                showTodayButton: false,
                showClear: false,
                showClose: true
            };

            $('#joining_date').datetimepicker(compactOptions);
            $('#date_of_birth').datetimepicker(compactOptions);

            // Make the input groups more compact
            // $('.compact-datepicker').css({
            //     'max-width': '200px'
            // });
        });
    </script>
@endpush