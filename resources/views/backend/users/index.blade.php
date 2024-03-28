@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
@endsection


@section('content')

    <div class="container my-container">
        <div class="row mb-5">
            <div class="col-md-3">
                <h4><strong> <i class="menu-icon tf-icons ti ti-users"></i> Users</strong></h4>
            </div>
        </div>


        <div class="table-responsive">
            <table id="example" class="display"
                   style="width:100%; background-color: #ffffff; color: black;">
                <thead style="background-color: #2d3748; color: white !important;">
                <tr>
                    <th>UserID</th>
                    <th>Created_at</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('after_js_stack')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            var table;

            $('#campaignSelect').change(function () {
                table.ajax.reload();
            });

            table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/backend/users/get-all-users",
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'roles', name: 'roles'},
                    {data: 'action', name: 'action'}
                ],

            });
        });
    </script>
@endpush
