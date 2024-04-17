@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                @include('layouts.frontend.top_auth')
                    <div class="row">
                        <h5><strong class="monstro text-white">FAZ LOGIN PARA PARTICIPAR:</strong></h5>
                        <h2 class="monstro" style="color: #db1d19"><strong>BEM-VINDO(A)!</strong></h2>
                    </div>
                    <div class="row my-3">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="name"
                                       class="form-control custom-input @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="Name*" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email"
                                       class="form-control custom-input @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="Email*" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password"
                                       class="form-control custom-input @error('password') is-invalid @enderror required"
                                       placeholder="Password*" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <input type="password" name="password_confirmation" class="form-control custom-input"
                                       placeholder="Confirmar Password*" required>
                                <span class="text-white myriad"
                                      style="font-size: 12px">*CAMPOS DE PREENCHIMENTO OBRIGATÓRIO</span>
                            </div>


                            <div class="mb-3 form-check">
                                <input type="checkbox" name="accept_privacy" id="accept_privacy"
                                       class="form-check-input custom-check-input @error('accept_privacy') is-invalid @enderror"
                                       required>
                                <label class="form-check-label text-white myriad" for="accept_privacy">Accept Termenii și
                                    Condițiile</label>
                                @error('accept_privacy')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="accept_terms" id="accept_terms"
                                       class="form-check-input custom-check-input @error('accept_terms') is-invalid @enderror"
                                       required>
                                <label class="form-check-label text-white myriad" for="accept_terms">Accept Politica de
                                    Confidențialitate</label>
                                @error('accept_terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mt-3">
                                <button type="submit" class="btn main_button d-grid mx-auto monstro">SUBMETER</button>
                            </div>
                        </form>
                    </div>
                @include('layouts.frontend.footer_auth')
                </div>
            </div>
        </div>
    </div>

@endsection
