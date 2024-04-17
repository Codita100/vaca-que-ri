@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                @include('layouts.frontend.top_auth')
                <div class="row text-center">
                    <h5><strong class="monstro" style="color:#c22522">PARA PODER PARTICIPAR É NECESSÁRIO TER MAIS DE 18
                            ANOS.</strong></h5>
                    <h5><strong class="monstro text-white">POR FAVOR, INTRODUZA A SUA DATA DE NASCIMENTO.</strong></h5>

                </div>
                <form action="{{route('age.submit')}}" method="get">
                    <div class="row my-3">
                        <div class="col-md-6 mx-auto">
                            <div class="row my-3">
                                <div class="col">
                                    <input type="text" maxlength="2" size="4" class="form-control custom-input"
                                           placeholder="DD" name="day">
                                </div>
                                <div class="col">
                                    <input type="text" maxlength="2" size="4" class="form-control custom-input"
                                           placeholder="MM" name="month">
                                </div>
                                <div class="col">
                                    <input type="text" maxlength="4" size="4" class="form-control custom-input"
                                           placeholder="YY" name="year">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <button class="btn main_button d-grid mx-auto mt-3 monstro" type="submit">SUBMETER</button>
                        </div>
                    </div>
                </form>

                @include('layouts.frontend.footer_auth')
            </div>
        </div>
    </div>
    </div>

@endsection
