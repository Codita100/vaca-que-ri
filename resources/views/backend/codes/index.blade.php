@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-container">
            <div><h4><strong>  <i class="menu-icon tf-icons ti ti-key"></i> Codes</strong></h4>
            </div>

            <div class="col-md-12 my-4">
                <form enctype="multipart/form-data" method="post" action="{{ route('codes.import') }}">
                    @csrf
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <input class="form-control" type="file" id="formFile" name="file">
                            <button type="submit" class="btn main_button mx-5" name="submit">Save</button>
                        </div>
                        <div>
                            <a href="{{ route('download.excel.codes') }}">Import Model</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row my-5">
                <table id="myTable" class="display"
                       style="width:100%; background-color: #ffffff; color: black;">
                    <thead style="background-color: #2d3748; color: white !important;">
                    <th>#</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Status</th>
                    </thead>
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
                ajax: "/backend/codes/get-all-codes",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'cod', name: 'cod'},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'status', name: 'status'},
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