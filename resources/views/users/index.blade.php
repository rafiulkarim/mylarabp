@extends('layouts.al305_main')
@section('title', 'Users')
@push('css')
    {{--
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/fixedHeader.dataTables.min.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/bs4/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugin/dataTables/fixedHeader.dataTables.min.css') }}">
    <style>
        /* Force row height */
        /* #basic-datatables tbody tr {
                height: 30px !important;
                line-height: 1.7 !important;
            }

            #basic-datatables tbody td {
                padding: 2px 8px !important;
                vertical-align: middle !important;
            } */

        /* Header styling - Updated to light green */
        #basic-datatables thead tr {
            background-color: #dff0d8 !important;
        }

        #basic-datatables thead th {
            background-color: #dff0d8 !important;
            color: #3c763d !important;
            /* Dark green text for contrast */
            padding: 10px 8px !important;
            border-bottom: 2px solid #d6e9c6 !important;
        }
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
            <a href="#">Users</a>
        </li>
        {{-- <li class="separator">
            <i class="fas fa-angle-right"></i>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{ url('role/create') }}">Create Role</a>
        </li> --}}
    </ul>
@endsection

@section('maincontent')
    {{-- <div class="row justify-content-center"> --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                Users List
            </div>
            <div class="card-body">
                <div>
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->cell_phone }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ isset($user->user_type) ? $user->user_type->title : '' }}
                                        </span>
                                    </td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <a title="Edit" class="bg-success p-1"
                                            href="{{ url('user/' . $user->id) }}"><i
                                                class="fa fa-eye text-white"></i></a>
                                        <a title="Edit" class="bg-primary p-1"
                                            href="{{ url('user/' . $user->id . '/edit') }}"><i
                                                class="fa fa-edit text-white"></i></a>
                                        <button type="button" data="{{ $user->id }}" title="Delete"
                                            class="bg-danger px-1 py-0  border-0 delete">
                                            <i class="fa fa-trash text-white"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--
    </div> --}}
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
                dom: "<'row'<'col-sm-12 col-md-12 text-center'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i>',
                        titleAttr: 'Copy to clipboard',
                        className: 'btn-sm btn-secondary',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i>',
                        titleAttr: 'Export to CSV',
                        className: 'btn-sm btn-info',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Export to Excel',
                        className: 'btn-sm btn-success',
                        title: 'Permission List',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i>',
                        titleAttr: 'Export to PDF',
                        className: 'btn-sm btn-danger',
                        title: 'Permission List',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Print table',
                        className: 'btn-sm btn-warning',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
        });

    </script>
    <script>
        $(document.body).on('click', '.delete', function () {
            let id = $(this).attr('data'); // Get the id from the data attribute
            // console.log(id)

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn btn-secondary",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Delete",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: false // Keep the alert open until AJAX completes
                    }
                }
            }).then((willDelete) => {
                if (willDelete) {
                    // Make the AJAX call here
                    $.ajax({
                        url: "{{ url('user') }}/" + id,
                        type: 'DELETE', // HTTP method
                        data: {
                            _token: '{{ csrf_token() }}', // Include CSRF token for security
                        },
                        success: function (response) {
                            // swal("Success!", "The record has been deleted.", "success");
                            swal({
                                title: "Success!",
                                text: "The record has been deleted.",
                                icon: "success",
                                position: "top-end", // positions the alert at the top-right
                                buttons: false, // hides buttons if you want it to be non-interactive
                                timer: 1500, // auto close after 3 seconds
                                customClass: {
                                    popup: 'swal2-custom-position'
                                }
                            });
                            // Optionally, remove the record from the UI
                            $(`[data="${id}"]`).closest('tr').remove();
                        },
                        error: function (xhr) {
                            swal("Error!", "Something went wrong while deleting the record.", "error");
                        }
                    });
                }
            });
        });
    </script>

@endpush