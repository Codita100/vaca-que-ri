@extends('layouts.frontend_master')

@section('content-frontend')
    <section class="background_second_color pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-2 d-none d-md-block align-self-end">
                    <img src="{{asset('images/graphics/section1_1.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <h3 class="second_color text-center monstro second_color"><strong>O MEU PERFIL</strong></h3>
                    </div>
                    <div class="circle-my-account mx-auto text-center d-flex justify-content-center align-items-center">
                        <div>
                            <h1 class="monstro">{{$totalPoints}}</h1>
                            <p>PONTOS ACUMULADOS</p>
                        </div>
                    </div>

                    <div class="mx-auto text-center d-flex justify-content-center align-items-center my-3">
                        <a class="btn yellow_button d-grid mx-auto mt-3 monstro" href="{{route('accumulate.index')}}"> SUBMETER NOVO CÓDIGO</a>
                    </div>

                    <div class="mx-auto text-center d-flex justify-content-center align-items-center main_color my-3">
                        <p class="mb-4 myriad">Notas: Não submetas o mesmo código duas vezes.</p>
                    </div>
                </div>
                <div class="col-md-2 d-none d-md-block align-self-start">
                    <img src="{{asset('images/graphics/section1_2.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
                <div class="col-md-2  d-none d-md-block" style="text-align: right;">
                    <img src="{{asset('images/graphics/section1_3.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
            </div>
        </div>
    </section>

    <section class="background_main_color p-5">
        <div class="container-fluid">
            <div class="row text-center my-5">
                <h3 class="text-white monstro"><strong>PREMIOS</strong></h3>
            </div>
            <div class="row">
                <div class="col-md-2 align-self-end">
                    <img src="{{asset('images/graphics/my_account_graphic1.png')}}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        @foreach($prizes as $product)

                            <div class="col-md-3 mx-auto my-5 p-3">
                                <div class="product position-relative">
                                    <div class="product-top">
                                        <div id="multiImageCarousel_{{$loop->index}}" class="carousel slide"
                                             data-bs-ride="carousel" data-bs-interval="false">
                                            <div class="carousel-inner">
                                                @foreach($product->multiImages as $key => $image)
                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                        <img
                                                            src="{{ asset('images/products_catalogue/' . $image->photo) }}"
                                                            class="d-block w-100" alt="Product Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#multiImageCarousel_{{$loop->index}}"
                                                    data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                    data-bs-target="#multiImageCarousel_{{$loop->index}}"
                                                    data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                        <div class="stock-overlay position-absolute top-0 start-0 p-2"
                                             style="margin-top: -24px; margin-left: -20px">
                                            <div class="label text-white px-3 py-1 rounded-pill-custom"
                                                 style="background-color: #E4211F">
                                                Ainda há: {{$product->stock}}
                                            </div>
                                        </div>

                                        <div class="stock-overlay position-absolute top-0 end-0 p-2"
                                             style="margin-top: -24px; margin-right: -20px">
                                            <div class="label text-dark px-3 py-1 rounded-pill-custom"
                                                 style="background-color: #FAF6EA">
                                                Já tenho: {{$product->userProductCount}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-bottom background_second_color text-center main_color">
                                        <div><h4 class="monstro second_color"><strong> {{$product->name}} </strong>
                                            </h4></div>
                                        <div class="my-3"><h4 class="second_color myriad">{{$product->points}}
                                                PONTOS</h4></div>

                                        <div><a class="btn main_button d-grid"
                                                href="{{ route('order.store', $product->id) }}">QUERO JÁ!</a></div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="col-md-2">
                    <img src="{{asset('images/graphics/my_account_graphic1.png')}}" class="img-fluid">
                </div>
            </div>
            <div class="row text-center mt-5">
                <h5 class="text-white">(Imagens meramente ilustrativas)</h5>
            </div>
        </div>
    @include('layouts.frontend.footer')
@endsection
