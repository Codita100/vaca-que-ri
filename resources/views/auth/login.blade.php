@extends('layouts.auth')
<!-- Content -->
@section('auth')
    <div class="mx-auto">
        <div class="text-center">
            <img class="img-fluid mx-auto" src="{{ asset('images/Logo.jpg') }}" style="width: 50%">
        </div>

        <div class="">
            <a href="{{route('register')}}" class="btn main_button">
                Ainado nao tenho conta
            </a>
        </div>

        <hr class="hr_custom">

        <div class="my-3">
            <a href="{{url('redirect/facebook')}}">
                <div class="button-facebook">
                    <div class="icon">
                        <img src="{{asset('images/facebook.png  ')}}" alt="Icon Facebook"/>
                    </div>
                    <div class="text">
                        Fazer login com Facebook
                    </div>
                </div>
            </a>
        </div>

        <div class="my-3">
            <a href="{{url('redirect/google')}}">
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


        <form id="formAuthentication" class="mb-3" action="{{route('login.user')}}" method="POST">
            @csrf
            <div class="mb-3">

                <input id="email" type="email"
                       class="form-control custom-input @error('email') is-invalid @enderror"
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
                           class="form-control custom-input @error('password') is-invalid @enderror"
                           name="password"
                           required autocomplete="current-password" placeholder="Password:">


                    @error('password')
                    <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                             </span>
                    @enderror
                </div>
            </div>
            <button class="btn main_button d-grid mx-auto">OK</button>

            <div class="text-center my-3">

                Esqueceste-te da password?<br>
                Andas a comer muito queijo! Repor
                <a href="{{route('forgot.password')}}">
                    <small>aqui.
                    </small>
                </a>
            </div>
        </form>
    </div>

@endsection
