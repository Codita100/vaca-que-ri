@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="mx-auto">
        <img src="{{asset('images/Logo.jpg')}}" width="70%">
        <h5><strong>FAZ LOGIN PARA PARTICIPAR:</strong></h5>
        <h2 class="main_color"><strong>BEM-VINDO(A)!</strong></h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">

                <input type="text" name="name" class="form-control custom-input @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Name*" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="Email*" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password"
                       class="form-control custom-input @error('password') is-invalid @enderror required"
                       placeholder="Password*"  required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control custom-input"
                       placeholder="Confirmar Password*" required>
                <span class="main_color" style="font-size: 12px">*CAMPOS DE PREENCHIMENTO OBLIGATORIO</span>
            </div>



            <div class="mb-3 form-check">
                <input type="checkbox" name="accept_privacy"
                       class="form-check-input @error('accept_privacy') is-invalid @enderror" required>
                <label class="form-check-label" for="accept_privacy">Accept Termenii și Condițiile</label>
                @error('accept_privacy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="accept_terms"
                       class="form-check-input @error('accept_terms') is-invalid @enderror" required>
                <label class="form-check-label" for="accept_terms">Accept Politica de Confidențialitate</label>
                @error('accept_terms')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <button type="submit" class="main_button">SUBMETER</button>
            </div>
        </form>
    </div>

@endsection
