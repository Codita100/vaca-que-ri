@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
    <section class="background_second_color my-5 ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main_color text-center"><strong>COMO PARTICIPAR</strong></h3>
                </div>
            </div>
        </div>
    </section>

    <section class="background_second_color">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                 <img src="{{asset('images/static/participation_1.jpg')}}" class="img-fluid" style="width: 60%" />
                    <p>1.COMPRA O PRODUCTO A VACA QUE RI COM O PACKAGING ESPECIAL DA CAMPANHA</p>
                </div>

                <div class="col-md-3 text-center">
                    <img src="{{asset('images/static/participation_2.jpg')}}" class="img-fluid" style="width: 60%" />
                    <p>2. REGISTA-TE NO WEBSITE</p>
                </div>

                <div class="col-md-3 text-center">
                    <img src="{{asset('images/static/participation_3.jpg')}}" class="img-fluid" style="width: 60%" />
                    <p>3. SUBMETE O CODIGO PRESENTE NO INTERIOR DA EMBALAGEM A VACA QUE RI</p>
                </div>

                <div class="col-md-3 text-center">
                    <img src="{{asset('images/static/participation_4.jpg')}}" class="img-fluid" style="width: 60%" />
                    <p>4. ACUMULA PONTOS E TROCA-OS PELOSTEUS PREMIOS FAVORITOS</p>
                </div>
            </div>
            <div class="row text-center my-5">
                <div class="col-md-3 mx-auto">
                <a  href="" class="btn main_button">PARTICIPA AQUI</a>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #fff" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="main_color text-center"><strong>ANCONTRA OS CODIGOS NO INTERIOR DAS EMBALAGENS D'A VACA QUE RI PORCOES E PALITOS 140G</strong></h3>
                </div>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/static/participation_s2_1.jpg')}}" class="img-fluid" style="width: 60%" />
                </div>

                <div class="col-md-4 text-center">
                    <img src="{{asset('images/static/participation_s2_2.jpg')}}" class="img-fluid" style="width: 60%" />
                </div>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/static/participation_s2_3.jpg')}}" class="img-fluid" style="width: 60%" />
                </div>

                <div class="col-md-4 text-center">
                    <img src="{{asset('images/static/participation_s2_4.jpg')}}" class="img-fluid" style="width: 60%" />
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
                                <img src="{{ asset('images/products_catalogue/' . $product->photo) }}" alt="Product Image" class="img-fluid w-100 h-100 product-image">
                                <div class="stock-overlay position-absolute top-0 start-0 p-2" style="margin-top: -24px; margin-left: -20px">
                                    <div class="label text-white px-3 py-1 rounded-pill" style="background-color: #E4211F">
                                        Stock: {{$product->stock}}
                                    </div>
                                </div>

                                <div class="stock-overlay position-absolute top-0 end-0 p-2" style="margin-top: -24px; margin-right: -20px">
                                    <div class="label text-dark px-3 py-1 rounded-pill" style="background-color: #FAF6EA">
                                        Stock: {{$product->stock}}
                                    </div>
                                </div>
                            </div>

                            <div class="product-bottom background_second_color text-center main_color">
                                <h4><strong> {{$product->name}} </strong></h4>
                                <h4>Points: {{$product->points}}</h4>

{{--                                <a class="btn main_button d-grid" href="{{ route('chelutie.puncte.acum', $product->id) }}">Quero Ja!</a>--}}
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>

@endsection
