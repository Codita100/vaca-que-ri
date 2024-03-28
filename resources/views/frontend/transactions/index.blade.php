@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
    <section class="background_second_color my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main_color text-center"><strong>OS MEUS CODIGOS</strong></h3>
                </div>
            </div>
        </div>
    </section>

    <section class="background_second_color">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="custom-table ">
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
        </div>
    </section>
@endsection
