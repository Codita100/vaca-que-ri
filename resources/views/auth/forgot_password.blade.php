@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="container">
        <div class="row my-0">
            <div class="col-md-9 mx-auto">
                @include('layouts.frontend.top_auth')
                <!-- /Logo -->
                <h4 class="mb-1 pt-2 text-white myriad">Você esqueceu a senha? </h4>
                <p class="mb-4 text-white myriad">Digite seu endereço de e-mail e enviaremos as instruções de redefinição
                    SENHA</p>
                <form id="formAuthentication" class="mb-3" action="{{route('password.email.post')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input
                            type="text"
                            class="myriad form-control custom-input"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            autofocus/>
                    </div>
                    <button class="btn main_button d-grid mx-auto mt-3 monstro">Send Reset Link</button>
                </form>
                <div class="text-center">
                    <a href="{{route('login')}}" class="d-flex align-items-center justify-content-center myriad">
                        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                        Back to login
                    </a>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
        @include('layouts.frontend.footer_auth')
    </div>

@endsection
