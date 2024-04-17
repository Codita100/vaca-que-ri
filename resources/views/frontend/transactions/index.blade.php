@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
    <section class="background_second_color pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-2 d-none d-md-block align-self-center">
                    <img src="{{asset('images/graphics/section1_1.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <h3 class="second_color text-center monstro second_color"><strong>OS MEUS CÓDIGOS</strong></h3>
                    </div>
                    <div class="circle-my-account mx-auto text-center d-flex justify-content-center align-items-center">
                        <div class="py-2">
                            <h1 class="monstro main_color">{{$totalPoints}}</h1>
                            <p class="myriad main_color" style="line-height: 14px">PONTOS ACUMULADOS</p>
                        </div>
                    </div>

                    <div class="mx-auto text-center d-flex justify-content-center align-items-center my-3">
                        <a class="btn yellow_button d-grid mx-auto mt-3 monstro" href="{{route('accumulate.index')}}">
                            SUBMETER NOVO CÓDIGO</a>
                    </div>

                    <div class="mx-auto text-center d-flex justify-content-center align-items-center main_color my-3">
                        <p class="mb-4 myriad">Notas: Não submetas o mesmo código duas vezes.</p>
                    </div>

                    <div class="mx-auto">
                        <div class="custom-table">
                            <div class="header-row">
                                <span class="header-cell">Data</span>
                                <span class="header-cell">Condigos</span>
                                <span class="header-cell">Pontos</span>
                                <span class="header-cell">Estado</span>
                            </div>

                            @foreach($transactions as $transaction)
                                @if($transaction->product_id == null && $transaction->accumulated_points == 0)
                                    <div class="data-row">
                                    <span
                                        class="data-cell">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</span>
                                        <span
                                            class="data-cell">{{$transaction->code}}</span>
                                        <span class="data-cell">{{$transaction->accumulated_points}}</span>
                                        <span class="data-cell text-danger"><strong>Invalido</strong></span>
                                    </div>
                                @else
                                    <div class="data-row">
                                    <span
                                        class="data-cell">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</span>
                                        <span
                                            class="data-cell">{{$transaction->code}}</span>
                                        <span class="data-cell">{{$transaction->accumulated_points}}</span>
                                        <span class="data-cell text-success"><strong>Valido</strong></span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-md-1 d-none d-md-block align-self-start">
                    <img src="{{asset('images/graphics/section1_2.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
                <div class="col-md-2  d-none d-md-block" style="text-align: right;">
                    <img src="{{asset('images/graphics/section1_3.png')}}" class="img-fluid" style="max-width: 200px">
                </div>
            </div>
        </div>
    </section>

{{--    <section class="background_second_color">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-2">--}}

{{--                </div>--}}
{{--                <div class="col-md-6 mx-auto">--}}
{{--                    <div class="custom-table ">--}}
{{--                        <div class="header-row">--}}
{{--                            <span class="header-cell">Data</span>--}}
{{--                            <span class="header-cell">Condigos</span>--}}
{{--                            <span class="header-cell">Pontos</span>--}}
{{--                            <span class="header-cell">Estado</span>--}}
{{--                        </div>--}}

{{--                        @foreach($transactions as $transaction)--}}
{{--                            @if($transaction->product_id == null && $transaction->accumulated_points == 0)--}}
{{--                                <div class="data-row">--}}
{{--                                    <span--}}
{{--                                        class="data-cell">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</span>--}}
{{--                                    <span--}}
{{--                                        class="data-cell">{{$transaction->code}}</span>--}}
{{--                                    <span class="data-cell">{{$transaction->accumulated_points}}</span>--}}
{{--                                    <span class="data-cell text-danger"><strong>Invalido</strong></span>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="data-row">--}}
{{--                                    <span--}}
{{--                                        class="data-cell">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</span>--}}
{{--                                    <span--}}
{{--                                        class="data-cell">{{$transaction->code}}</span>--}}
{{--                                    <span class="data-cell">{{$transaction->accumulated_points}}</span>--}}
{{--                                    <span class="data-cell text-success"><strong>Valido</strong></span>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
