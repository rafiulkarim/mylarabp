@extends('layouts.al305_main')
@section('title', '404 error')
@push('css')
@endpush
@section('breadcrumb')
    <h3 class="fw-bold">Error</h3>
@endsection

@section('maincontent')
    <div class="row justify-content-center">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>403 Error Page</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! You Do Not Have Permission To Access
                        This Page.</h3>

                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="{{ route('home') }}">return to dashboard. </a>
                    </p>

                    {{--<p>--}}
                        {{--You don't have the necessary permission to view this page.--}}
                        {{--</p>--}}
                    <p>
                        If you believe this is an error, please contact with System Admin.
                    </p>


                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')

@endpush