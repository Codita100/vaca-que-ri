@extends('layouts.app')

@section('css')
    /*<!--Datatables cdn-->*/
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
@endsection

@section('content')
    <section>
        <div class="container my-container">
            <div class="row mb-5">
                <h4><strong>   <i class="menu-icon tf-icons ti ti-star"></i> Points</strong></h4>
                <div class="table-responsive">
                    <table id="example" class="display"
                           style="width:100%; background-color: #ffffff; color: black;">
                        <thead style="background-color: #2d3748; color: white !important;">
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Points</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('after_js_stack')
    <!--Server side datatable. I have a query foreach page-->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/backend/points/get-all-transactions",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user'},
                    {data: 'email', name: 'email'},
                    {data: 'points', name: 'points'},
                ],

                bStateSave: true,
                columnDefs: [
                    {orderable: false, targets: []}
                ],
                order: [[0, 'desc']],

                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    [10, 25, 50, 100, 500]
                ],
            });
        });
    </script>
@endpush

