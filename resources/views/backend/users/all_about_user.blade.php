@extends('layouts.app')

@section('content')
    <div class="container my-container">
        <div>
            <h4><strong><i class="menu-icon tf-icons ti ti-users"></i> User Details</strong></h4>
            <ul>
                <li>Name:: {{ $user->name }}</li>
                <li>Email: {{ $user->email }}</li>
                <li>Active: {{ $user->email_verified_at ? 'Yes' : 'No' }}</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-3">Transactions</h5>
                        <h2 class="m-0">Points: {{$totalPoints}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <table id="myTable" class="display" style="width:100%; background-color: #ffffff; color: black;">
                <thead style="background-color: black; color: white !important;">
                <tr>
                    <th>#</th>
                    <th>Transaction Type</th>
                    <th>Code</th>
                    <th>Transaction<br> IN Points</th>
                    <th>Transaction<br> OUT Points</th>
                    <th>Created_at</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($orders as $transaction)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$transaction->transactionin ? 'IN': 'OUT'}}</td>
                        <td>{{$transaction->transactionin ? $transaction->transactionin->code : '-'}}</td>
                        <td>{{$transaction->transactionin ? $transaction->transactionin->accumulated_points : '-'}}</td>
                        <td>{{$transaction->transactionout ? $transaction->transactionout->consumed_points : '-'}}</td>
                        <td>{{$transaction->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row my-3">
            <table id="orders" class="display" style="width:100%; background-color: #ffffff; color: black;">
                <thead style="background-color: black; color: white !important;">
                <tr>
                    <th>#</th>
                    <th>OrderId</th>
                    <th>Product</th>
                    <th>Points</th>
                    <th>Created_at</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($catalog_orders as $order)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$order->id}}</td>
                        <td>{{$order->productCatalog->name}}</td>
                        <td>{{$order->productCatalog->points}}</td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection

@section('after_js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#orders').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
@endsection
