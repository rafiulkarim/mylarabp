@extends('layouts.al305_main')
@section('title', 'Users')
@push('css')

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
                        <img class="rounded-circle" src="{{ asset('assets/img/profile.jpg') }}" alt="profile">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush