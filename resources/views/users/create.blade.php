@extends('layouts.al305_main')
@section('title','Create User')
@push('css')
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
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name">
                            <small id="nameError" class="form-text text-muted">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                            <small id="emailHelp2" class="form-text text-muted">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-phone"></i>
                            </span>
                            <input type="text" pattern="01[3-9][0-9]{8}" class="form-control"
                                   placeholder="Enter Mobile Number">
                            <small id="emailHelp2" class="form-text text-muted">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control"
                                   placeholder="Enter Password">
                            <small id="emailHelp2" class="form-text text-muted">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control"
                                   placeholder="Enter Confirm Password">
                            <small id="emailHelp2" class="form-text text-muted">
                            </small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">User Type</label>
                        <select class="form-select" id="exampleFormControlSelect1">
                            <option>Select User Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender" checked>
                                <label class="form-check-label" for="gender">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2">
                                <label class="form-check-label" for="gender">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Web Access</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="web_access" id="web_access" checked>
                                <label class="form-check-label" for="web_access">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="web_access" id="flexRadioDefault2" >
                                <label class="form-check-label" for="web_access">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</button>
                    <button class="btn btn-success float-end" id="saveButton">Submit <i class="fa fa-save"></i> </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document.body).on('click','#saveButton', function (){
            console.log('comes')
        })
    </script>
@endpush
