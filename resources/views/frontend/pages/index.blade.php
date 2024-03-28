@extends('layouts.frontend_master')
@section('content-frontend')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$value->page_name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $value->page_content !!}
            </div>
        </div>
    </div>
@endsection
