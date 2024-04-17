@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="container">
        <div class="row my-0">
            <div class="col-md-9 mx-auto">
           @include('layouts.frontend.top_auth')

                <div class="my-3">
                    <a href="{{route('register')}}" class="btn white_button form-control myriad">
                        Ainda não tenho conta
                    </a>
                </div>

                <hr class="hr_custom">

                <div class="row">
                    <div class="my-1">
                        <a href="{{url('redirect/facebook')}}" class="myriad">
                            <div class="button-facebook">
                                <div class="icon">
                                    <img src="{{asset('images/facebook.png')}}" alt="Icon Facebook"/>
                                </div>
                                <div class="text">
                                    Fazer login com Facebook
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="my-2">
                        <a href="{{url('redirect/google')}}" class="myriad">
                            <div class="button-google">
                                <div class="icon">
                                    <img src="{{asset('images/google.png')}}" alt="Icon Google"/>
                                </div>
                                <div class="text">
                                    Fazer login via Google
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <form id="formAuthentication" class="mb-3" action="{{route('login.user')}}" method="POST">
                        @csrf
                        <div class="mb-3">

                            <input id="email" type="email"
                                   class="myriad form-control custom-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Email:">
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                        <div class="mb-3 form-password-toggle">

                            <div class="input-group input-group-merge">
                                <input id="password" type="password"
                                       class="myriad form-control custom-input @error('password') is-invalid @enderror"
                                       name="password"
                                       required autocomplete="current-password" placeholder="Password:">


                                @error('password')
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                             </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn main_button  d-grid mx-auto mt-3 monstro">OK</button>

                        <div class="text-center my-3 text-white myriad">
                            Esqueceste-te da password?<br>
                            Andas a comer muito queijo!
                            <a href="{{route('forgot.password')}}">
                                <strong> Repor aqui.
                                </strong>
                            </a>
                        </div>
                    </form>
                </div>
                @include('layouts.frontend.footer_auth')
            </div>
        </div>
    </div>


@endsection
