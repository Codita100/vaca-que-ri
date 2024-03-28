@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-container">
            <div><h4><strong> <i class="menu-icon tf-icons ti ti-book"></i> Catalogue</strong></h4>
            </div>

            <div class="col-md-2 my-4">
                <a href="{{ route('product.catalogue.create')}}" class="btn main_button">Add a product</a>
            </div>

            <div class="row my-5">
                <table id="myTable" class="display"
                       style="width:100%; background-color: #ffffff; color: black;">
                    <thead style="background-color: #2d3748; color: white !important;">
                    <th>#</th>
                    <th>Name</th>
                    <th>Points</th>
                    <th>Stock</th>
                    <th>Photo</th>
                    <th>Action</th>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('after_js_stack')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/backend/catalogue/get-all-catalog-products",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'points', name: 'points'},
                    {data: 'stock', name: 'stock'},
                    {data: 'photo', name: 'photo'},
                    {data: 'action', name: 'action'},
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

