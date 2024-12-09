@extends('layouts.al305_main')
@section('title','Permission')
@push('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/fixedHeader.dataTables.min.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/bs4/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/fixedHeader.dataTables.min.css') }}">
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
        <div class="card">
            <div class="card-body">
                <div>
                    <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                    >
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($permissions as $key => $permission)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $permission->title }}</td>
                                <td>{{ $permission->status }}</td>
                                <td>
                                    <a title="Edit" class="bg-primary p-1"
                                       href="{{ url('permission/'. $permission->id. '/edit') }}"><i
                                            class="fa fa-edit text-white"></i></a>
                                    <button type="button" data="{{ $permission->id }}" title="Delete"
                                            class="btn btn-link btn-danger delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/dataTables/bs4/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugin/dataTables/dataTables.fixedHeader.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#basic-datatables').DataTable({
                aaSorting: [],
                pageLength: 25,
                responsive: true,
                fixedHeader: true,
//            dom: '<"html5buttons"B>lTfgtip',
                'dom': "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'User List'},
                    {extend: 'pdf', title: 'User List'},
                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        $(document.body).on('click', '.delete', function () {
            let id = $(this).attr('data')
            swal("Good job!", "You clicked the button!", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            });
        })
    </script>
@endpush
