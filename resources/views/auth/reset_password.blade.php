@extends('layouts.auth')

@section('auth')
    <div class="container">
        <div class="row my-0">
            <div class="col-md-9 mx-auto">
                @include('layouts.frontend.top_auth')
                <!-- /Logo -->
                <h4 class="mb-1 pt-2 text-white myriad">Resetare parola </h4>
                <p class="mb-4 text-white myriad">pentru {{$user->email}}</p>
                <form id="formAuthentication" action="{{route('update.password')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control input_shadow" id="token" name="token"
                           value="{{ $token }}">
                    <div class="row my-3">
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control custom-inputt"
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
                                class="form-control custom-input"
                                name="password_confirmation"
                            />

                        </div>
                        <div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn main_button d-grid w-100 mb-3">Save password</button>
                    <div class="text-center">
                        <a href="{{route('login')}}">
                            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                          Back to login
                        </a>
                    </div>
                </form>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>

@endsection
