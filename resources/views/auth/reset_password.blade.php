@extends('layouts.auth')

@section('auth')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4 mt-2">
                    <a href="index.html" class="app-brand-link gap-2">
                             <span class="app-brand-text demo text-body fw-bold">
                                    <img src="{{asset('images/Logo.jpg')}}" width="150px"></span>

                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1 pt-2">Resetare parola 🔒</h4>
                <p class="mb-4">pentru <span class="fw-medium">{{$user->email}}</span></p>
                <form id="formAuthentication" action="{{route('update.password')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control input_shadow" id="token" name="token"
                           value="{{ $token }}">
                    <div class="row my-3">
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Parola noua</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                />

                            </div>
                        </div>
                        <div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password_confirmation">Confirma parola noua</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="confirm-password"
                                class="form-control"
                                name="password_confirmation"
                            />

                        </div>
                        <div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100 mb-3">Salveaza parola</button>
                    <div class="text-center">
                        <a href="{{route('login')}}">
                            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                            Inapoi la login
                        </a>
                    </div>
                </form>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>

@endsection
