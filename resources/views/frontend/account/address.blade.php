@extends('layouts.frontend_master')

<!-- Content -->
@section('content-frontend')
    <section class="background_second_color py-5 px-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center monstro second_color"><strong>OS MEUS DADOS</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center monstro main_color"><strong>PREENCHE OS TEUS DADOS PARA PARTICIPAR NO NOSSO PASSATEMPO.</strong></h6>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 d-none d-md-block align-self-end">
                    <img src="{{asset('images/graphics/address_graphic1.png')}}" class="img-fluid" style="max-width: 200px">
                </div>

                <div class="col-md-6 px-4">
                    <form action="{{ route('address.store') }}" method="post">
                        @csrf

                        <div class="my-3">
                            <input type="text" class="form-control custom-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ? old('name') : ($user ? $user->name : '') }}" placeholder="{{ $user ? '' : 'Nome*' }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="number" class="form-label">Data de Nascimento*</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" maxlength="2" size="4" class="form-control custom-input" name="day" value="{{ old('day') ? old('day') : ($user->address ? $user->address->day : '') }}" >
                                </div>
                                <div class="col">
                                    <input type="text" maxlength="2" size="4" class="form-control custom-input" name="month" value="{{ old('month') ? old('month') : ($user->address ? $user->address->month : '') }}" >
                                </div>
                                <div class="col">
                                    <input type="text" maxlength="4" size="4" class="form-control custom-input" name="year" value="{{ old('year') ? old('year') : ($user->address ? $user->address->year : '') }}" >
                                </div>
                            </div>

                            @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control custom-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ? old('email') : ($user ? $user->email : '') }}" placeholder="{{ $user ? '' : 'Email*' }}" readonly>

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->address ? $user->address->phone : '') }}" placeholder="Telefone*" >

                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control custom-input @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') ? old('address') : ($user->address ? $user->address->address : '') }}" placeholder="Morada*" >
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="number" class="form-label">Código Postal*</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text"  maxlength="4" class="form-control custom-input" name="postal" value="{{ old('postal') ? old('postal') : ($user->address ? $user->address->postal : '') }}" placeholder="0000">
                                </div>
                                <div class="col">
                                    <input type="text"  maxlength="3" class="form-control custom-input" name="code" value="{{ old('code') ? old('code') : ($user->address ? $user->address->code : '') }}" placeholder="000">
                                </div>
                                <div class="col">
                                    <input type="text"  class="form-control custom-input" name="city" value="{{ old('city') ? old('city') : ($user->address ? $user->address->city : '') }}" placeholder="Localidade" >
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 main_color" style="font-size: 12px">*CAMPOS DE PREENCHIMENTO OBRIGATÓRIO
                        </div>


                        <div class="mb-3 form-check">
                            <input type="checkbox" name="accept_privacy" id="accept_privacy"
                                   class="form-check-input custom-check-input @error('accept_privacy') is-invalid @enderror"
                                   required @if($user->accept_privacy) checked @endif>
                            <label class="form-check-label main_color myriad" for="accept_privacy" style="font-size: 12px" >LI E ACEITO O TRATAMENTO DOS MEUS DADOS PESSOAIS CONFORME ACIMA DESCRITO.</label>
                            @error('accept_privacy')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="accept_terms" id="accept_terms"
                                   class="form-check-input custom-check-input @error('accept_terms') is-invalid @enderror"
                                   required @if($user->accept_terms) checked @endif>
                            <label class="form-check-label main_color myriad" for="accept_terms" style="font-size: 12px">LI E ACEITO O REGULAMENTO DA CAMPANHA.</label>
                            @error('accept_terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="my-5">
                            <button type="submit" class="btn yellow_button d-grid mx-auto monstro">SUBMETER</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-3 d-none d-md-block align-self-center text-end">
                    <img src="{{asset('images/graphics/address_graphic2.png')}}" class="img-fluid" style="width: 80%">
                </div>
            </div>
        </div>
    </section>
    @include('layouts.frontend.footer2')
@endsection
