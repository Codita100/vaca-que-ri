@extends('layouts.app')

@section('css')
    /*<!--Datatables cdn-->*/
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
@endsection

@section('content')

    <div class="container my-container">
        <div class="row">
            <div class="col-md-12">
                <h4><strong>  <i class="menu-icon tf-icons ti ti-shopping-cart"></i> Orders</strong></h4>
            </div>
        </div>


        <div class="row">
            <div class="table-responsive">
                <table id="example" class="display"
                       style="width:100%; background-color: #ffffff; color: black;">
                    <thead style="background-color: #2d3748; color: white !important;">
                    <th>#</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Action</th>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@endsection

@push('after_js_stack')
    <!--Server side datatable. I have a query foreach page-->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.index') }}/get-all-orders",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'user', name: 'user'},
                    {data: 'product_catalog', name: 'product_catalog'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
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
