@extends('layouts.frontend_master')
@section('content-frontend')
    <section class="background_second_color py-5">
        <div class="container-fluid background_second_color">
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2 class="text-center monstro second_color">{{$value->page_name}}</h2>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row my-5 px-3">

                <div class="col-md-2 text-md-end d-none d-md-block col align-self-center">
                    <img src="{{asset('images/graphics/regulamento_graphics1.png')}}" class="img-fluid"
                         style="width: 60%">
                </div>
                <div class="col-md-8 main_color">
                    {!! $value->page_content !!}
                </div>
                <div class="col-md-2 text-md-end d-none d-md-block">
                    <img src="{{asset('images/graphics/regulamento_graphics2.png')}}" class="img-fluid"
                         style="width: 60%">
                </div>
            </div>
        </div>
    </section>
@endsection
