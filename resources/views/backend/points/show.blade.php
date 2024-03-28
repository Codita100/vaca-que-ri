@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-container">
            <div class="row my-5">
                {{--                <h4><strong>{{$user->firstname}} {{$user->lastname}} : {{$totalPoints}} points</strong></h4>--}}
                <table>
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Transaction Type</th>
                        <th>Transaction IN Points</th>
                        <th>Transaction OUT Points</th>
                        <th>Product/Catalog</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->user->name}}</td>
                            <td>{{$transaction->transactionin ? 'IN': 'OUT'}}</td>
                            <td>{{$transaction->transactionin ? $transaction->transactionin->accumulated_points : 'null'}}</td>
                            <td>{{$transaction->transactionout ? $transaction->transactionout->consumed_points : 'null'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </section>

@endsection

@section('after_js')
    <script>
        $(document).ready(function () {
            $('#tabel').DataTable();
        });
    </script>
@endsection

