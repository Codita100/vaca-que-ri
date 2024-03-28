@extends('layouts.auth')
<!-- Content -->
@section('auth')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->

                <!-- Logo -->
                <div class="justify-content-center mb-4 mt-2">
                    <a href="index.html" class="app-brand-link gap-2">

                                <span class="app-brand-text demo text-body fw-bold">
                                    <img src="{{asset('images/Logo.jpg')}}" width="150px"></span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1 pt-2">Ai uitat parola? 🔒</h4>
                <p class="mb-4">Introdu adresa de email iar noi iti trimitem instructiunile pentru resetarea
                    parolei</p>
                <form id="formAuthentication" class="mb-3" action="{{route('password.email.post')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            autofocus/>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                </form>
                <div class="text-center">
                    <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                        Back to login
                    </a>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

@endsection
