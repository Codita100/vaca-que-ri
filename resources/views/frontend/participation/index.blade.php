@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
<style>
    @media (max-width: 768px) {
        .img-sm {
            width: 50%;
        }
    }
</style>
    <section class="background_second_color py-5 px-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="my-3">
                            <h3 class="text-center monstro second_color"><strong>COMO PARTICIPAR</strong></h3>
                        </div>
                        <div class="col-md-3 text-center">

                            <img src="{{asset('images/static/participation_1.jpg')}}" class="img-fluid img-sm" />
                            <p class="myriad main_color" style="font-size: 15px"><strong>1. COMPRA O PRODUTO A VACA QUE
                                    RI COM O
                                    PACK PROMOCIONAL</strong></p>
                        </div>


                        <div class="col-md-3 text-center">
                            <img src="{{asset('images/static/participation_2.jpg')}}"  class="img-fluid img-sm" />
                            <p class="myriad main_color" style="font-size: 15px"><strong>2. REGISTA-TE NO
                                    WEBSITE </strong></p>
                        </div>

                        <div class="col-md-3 text-center">
                            <img src="{{asset('images/static/participation_3.jpg')}}"  class="img-fluid img-sm" />
                            <p class="myriad main_color" style="font-size: 15px"><strong>3. SUBMETE O CÓDIGO PRESENTE NO
                                    INTERIOR DO PACK PROMOCIONAL </strong></p>
                        </div>

                        <div class="col-md-3 text-center">
                            <img src="{{asset('images/static/participation_4.jpg')}}"  class="img-fluid img-sm" />
                            <p class="myriad main_color" style="font-size: 15px"><strong>4. ACUMULA PONTOS E TROCA-OS
                                    PELOS TEUS
                                    PRÉMIOS FAVORITOS </strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-md-end d-none d-md-block">
                    <img src="{{asset('images/graphics/como_participar_graphic3.png')}}" class="img-fluid"
                         style="width: 60%">
                </div>
            </div>
            <div class="row text-center my-5">
                <div class="col-md-3 mx-auto">
                    <a href="" class="btn yellow_button monstro">PARTICIPA AQUI</a>
                </div>
            </div>
        </div>
    </section>



    <section style="background-color: #fff" class="py-md-5 px-3">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-2 align-self-start d-none d-md-block" style="margin-top: -100px; max-width: 220px">
                    <img src="{{asset('images/graphics/como_participar_graphic1.png')}}" class="img-fluid  mx-auto">
                </div>
                <div class="col-md-8 my-md-5 mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 my-5">
                            <h3 class="second_color text-center monstro"><strong>ENCONTRA OS CÓDIGOS NO INTERIOR DOS
                                    PACKS
                                    PROMOCIONAIS
                                    D’A VACA QUE RI PORÇÕES E PALITOS 140G</strong></h3>
                        </div>

                        <div class="col-md-5 col-6 text-center">
                            <img src="{{ asset('images/static/participation_s2_1.jpg') }}" class="img-fluid" style="max-width: 80%"/>
                        </div>


                        <div class="col-md-5  col-6 text-center">
                            <img src="{{asset('images/static/participation_s2_2.jpg')}}" class="img-fluid" style="max-width: 80%"/>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5 col-6 text-center">
                            <img src="{{asset('images/static/participation_s2_3.jpg')}}" class="img-fluid" style="max-width: 80%"/>
                        </div>

                        <div class="col-md-5 col-6 text-center">
                            <img src="{{asset('images/static/participation_s2_4.jpg')}}" class="img-fluid" style="max-width: 80%"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 align-self-end d-none d-md-block" style="margin-bottom: -100px; max-width: 250px">
                    <img src="{{asset('images/graphics/como_participar_graphic2.png')}}" class="img-fluid">
                </div>
            </div>
        </div>
    </section>


    <section class="background_main_color p-5">
        <div class="container-fluid">
            <div class="row text-center my-5">
                <h3 class="text-white monstro"><strong>PRÉMIOS DISPONÍVEIS</strong></h3>
            </div>
            <div class="row">
                <div class="col-md-2 align-self-end">
                    <img src="{{asset('images/graphics/my_account_graphic1.png')}}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        @foreach($prizes as $product)

                            <div class="col-md-3 mx-auto my-md-5 p-3">
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
                                        @auth()
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
                                        @endauth
                                    </div>


                                    <div class="product-bottom background_second_color text-center main_color">
                                        <div><h4 class="monstro second_color"><strong> {{$product->name}} </strong>
                                            </h4></div>
                                        <div class="my-3"><h4 class="second_color myriad">{{$product->points}}
                                                PONTOS</h4></div>
                                        @auth()
                                            <div><a class="btn main_button d-grid"
                                                    href="{{ route('consume.store', $product->id) }}">QUERO JÁ!</a></div>
                                        @endauth
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
        </div>
    </section>

    @include('layouts.frontend.footer')

@endsection
