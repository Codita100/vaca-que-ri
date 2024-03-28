@extends('layouts.app')

@section('content')
    <h1>Reports</h1>

    <div class="row mt-5">
        <div class="col-md-4 p-3" style="background-color: #fcfcfc">
            <form method="get" action="{{ route('export.points') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h6>User - Points</h6>
                    </div>
                </div>

                <button type="submit" class="btn btn main_button">Export</button>
            </form>
        </div>

        <div class="col-md-4 p-3" style="background-color: #f1efef">
            <form method="get" action="{{ route('export.orders') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h6>User - Orders</h6>
                    </div>
                </div>

                <button type="submit" class="btn btn main_button">Export</button>
            </form>
        </div>
    </div>
@endsection
