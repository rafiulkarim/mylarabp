@extends('layouts.al305_main')
@section('title', 'Users')
@push('css')
    <link href="{!! asset('supporting/bootstrap-fileinput/bootstrap-fileinput.css')!!}" rel="stylesheet" type="text/css" />
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
                                    class="fas fa-lock-open me-2"></i>Role & Access</a>
                        </li>
                        @if (Auth::user()->id == $user->id)
                            <li class="nav-item submenu" role="presentation">
                                <a class="nav-link" id="line-home-tab" data-bs-toggle="pill" href="#update-avatar" role="tab"
                                    aria-controls="pills-home" aria-selected="false" tabindex="-1"><i
                                        class="fas fa-user-tie me-2"></i>Avatar</a>
                            </li>
                            <li class="nav-item submenu" role="presentation">
                                <a class="nav-link" id="line-profile-tab" data-bs-toggle="pill" href="#update-password"
                                    role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1"><i
                                        class="fas fa-unlock-alt me-2"></i>Password</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content mt-3 mb-3" id="line-tabContent">
                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="line-home-tab">
                            <div class="ms-4">
                                <strong>Name: </strong> {{ $user->name ?? 'N/A' }} <br>
                                <strong>Email: </strong> {{ $user->email ?? 'N/A' }} <br>
                                <strong>Phone: </strong> {{ $user->cell_phone ?? 'N/A' }} <br>
                                <strong>Address: </strong> {{ isset($user->profile) ? $user->profile->address : 'N/A' }}
                                <br>
                                <strong>Joining date: </strong>
                                {{ isset($user->profile) ?
        ($user->profile->joining_date != null ? \Carbon\Carbon::parse($user->profile->joining_date)->format('d-M-Y') : 'N/A') : 'N/A' }}
                                <br>
                                <strong>Date of Birth: </strong>
                                {{ isset($user->profile) ?
        ($user->profile->date_of_birth != null ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d-M-Y') : 'N/A') : 'N/A' }}
                                <br>
                                <strong>NID: </strong> {{ isset($user->profile) ? $user->profile->nid ?? 'N/A' : 'N/A' }}
                                <br>
                                <strong>Gender: </strong>
                                {{ isset($user->profile) ? $user->profile->gender ?? 'N/A' : 'N/A' }} <br>
                                <strong>Created At: </strong>
                                {{ isset($user->profile) ?
        ($user->profile->created_at != null ? \Carbon\Carbon::parse($user->profile->created_at)->format('d-M-Y') : 'N/A') : 'N/A' }}
                                <br>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="roleAndAccess" role="tabpanel" aria-labelledby="line-profile-tab">
                            <div class="ms-4">
                                <strong>User Type: </strong> <span
                                    class="badge badge-success">{{ isset($user->user_type) ? $user->user_type->title : '' }}</span>
                                <br>
                                <strong>Permissions: </strong> <br>
                                <div class="ms-5">
                                    @foreach ($user->roles as $role)
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge badge-primary me-1 mb-1">{{ $permission->title }}</span>
                                        @endforeach
                                    @endforeach
                                </div>
                                <br>
                            </div>
                        </div>
                        @if (Auth::user()->id == $user->id)
                            <div class="tab-pane fade" id="update-avatar" role="tabpanel" aria-labelledby="line-profile-tab">
                                <div class="ms-4">
                                    <form action="{{ url('profile_image') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="profile_image_id">
                                        <div class="form-group">
                                            <h3>Profile Picture</h3>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    @if ($user->imageprofile->image != 'default_image.png')
                                                        <img class="rounded-circle img-fluid avatar-img"
                                                            style="width: 150px; height: 150px;"
                                                            src="{{ asset('storage/images/' . $user->imageprofile->image) }}"
                                                            alt="profile">
                                                    @elseif($user->profile->gender == "Male")
                                                        <img class="rounded-circle img-fluid avatar-img"
                                                            style="width: 150px; height: 150px;"
                                                            src="{{ asset('storage/images/default_image_male.png') }}"
                                                            alt="profile">
                                                    @elseif($user->profile->gender == "Female")
                                                        <img class="rounded-circle img-fluid avatar-img"
                                                            style="width: 150px; height: 150px;"
                                                            src="{{ asset('storage/images/default_image_female.png') }}"
                                                            alt="profile">
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
                                        <hr />
                                        <div class="row">
                                            <div class="callout callout-warning">
                                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                                <p>
                                                    <span style="font-size: 12px"> Prefered image size for Avatar is 300X300 &
                                                        not more then 1MB. Supported image type should be jpeg, jpj, png and
                                                        bmp. Attached image thumbnail is supported in Latest Firefox, Chrome,
                                                        Opera, Safari and Internet Explorer 10 only </span>
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
                            <div class="tab-pane fade" id="update-password" role="tabpanel" aria-labelledby="line-profile-tab">
                                <div class="ms-4">
                                    <form action="{{ url('profile-settings') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                        <div class="form-group row">
                                            <label for="password" style="text-align: right"
                                                class="col-md-3 required-field"><strong>Passwrod</strong> :</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control form-control-sm" required placeholder="Enter Passwrod">
                                                </div>
                                                <small id="passwordError" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="confirm_password" style="text-align: right"
                                                class="col-md-3 required-field"><strong>Confirm Passwrod</strong> :</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="password" name="confirm_password" id="confirm_password" required
                                                        class="form-control form-control-sm"
                                                        placeholder="Enter Confirm Passwrod">
                                                </div>
                                                <small id="confirm_password_error" class="form-text text-danger"></small>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{!! asset('supporting/bootstrap-fileinput/bootstrap-fileinput.js') !!}" type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            $('.fileinput').fileinput(); // ensure initialization
        });
    </script>
@endpush