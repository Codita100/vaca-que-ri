@extends('layouts.frontend_master')

@section('content-frontend')
    <section class="background_second_color my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main_color text-center"><strong>O MEU PERFIL</strong></h3>
                </div>
                <div class="col-md-12">
                    <div class="circle-my-account mx-auto text-center d-flex justify-content-center align-items-center">
                        <div>
                            <h1>{{$totalPoints}}</h1>
                            <p>lala</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="background_main_color p-5">
        <div class="container">
            <div class="row text-center my-5">
                <h3 class="second_color"><strong>PREMIOS</strong></h3>
            </div>
            <div class="row">
                @foreach($prizes as $product)
                    <div class="col-md-3 mx-auto my-5 p-3">
                        <div class="product position-relative">
                            <div class="product-top">
                                <div id="multiImageCarousel_{{$loop->index}}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                                    <div class="carousel-inner">
                                        @foreach($product->multiImages as $key => $image)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('images/products_catalogue/' . $image->photo) }}" class="d-block w-100" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#multiImageCarousel_{{$loop->index}}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#multiImageCarousel_{{$loop->index}}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                                <div class="stock-overlay position-absolute top-0 start-0 p-2" style="margin-top: -24px; margin-left: -20px">
                                    <div class="label text-white px-3 py-1 rounded-pill" style="background-color: #E4211F">
                                        Stock: {{$product->stock}}
                                    </div>
                                </div>

                                <div class="stock-overlay position-absolute top-0 end-0 p-2" style="margin-top: -24px; margin-right: -20px">
                                    <div class="label text-dark px-3 py-1 rounded-pill" style="background-color: #FAF6EA">
                                        You have: {{$product->userProductCount}}
                                    </div>
                                </div>
                            </div>

                            <div class="product-bottom background_second_color text-center main_color">
                                <h4><strong> {{$product->name}} </strong></h4>
                                <h4>Points: {{$product->points}}</h4>

                                <a class="btn main_button d-grid" href="{{ route('order.store', $product->id) }}">Quero Ja!</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
