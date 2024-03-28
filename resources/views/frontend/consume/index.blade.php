@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
    <section class="background_second_color my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main_color text-center"><strong>ACCUMULATE POINTS</strong></h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a href="{{route('chelutie.puncte.acum', $product->id)}}"> <img
                                    src="{{asset('images/products_catalogue/'. $product->photo) }}" class="card-img-top"
                                    alt="{{ $product->name }}"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Points: {{ $product->points }}</p>
                                <p class="card-text">Stock: {{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
