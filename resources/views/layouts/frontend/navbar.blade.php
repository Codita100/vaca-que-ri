@auth()
    <style>
        @media only screen and (min-width: 768px) {
            .navbar-expand-md .navbar-collapse {
                display: flex !important;
                flex-basis: auto;
                padding-left: 40px;
            }
        }

        .navbar-toggler {
            background-color: #2d3748;

        }

        .custom-toggler .navbar-toggler-icon {
            background-image: url(
            "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23fff' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

    </style>

    <nav class="navbar navbar-expand-md front-nav">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <a class="navbar-brand d-md-none justify-content-center align-items-center" href="#">
                    <img src="{{asset('images/Logo2.png')}}" alt="" class="img-fluid" style="width: 175px">
                </a>
            </div>

            <div class="row align-items-start">
                <div class="col">
                    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="monstro main_color nav-link @if(request()->routeIs('account.index')) active-link @endif"
                           aria-current="page" href="{{route('account.index')}}">PERFIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('address.index')) active-link @endif"
                           href="{{route('address.index')}}">DADOS DE ENVIO</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('transactions.index')) active-link @endif"
                           href="{{route('transactions.index')}}">CONDIGOS</a>
                    </li>

                    <a class="navbar-brand d-none d-md-block" href="#">
                        <img src="{{asset('images/Logo2.png')}}" alt="" class="img-fluid" style="width: 185px">
                    </a>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('participation.index')) active-link @endif"
                           href="{{route('participation.index')}}">COMO PARTICIPAR</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('displayStaticPage','regulamento')) active-link @endif"
                           href="{{route('displayStaticPage','regulamento')}}">REGULAMENTO</a>
                    </li>


                    <li class="nav-item">

                        <a class="nav-link @if(request()->routeIs('logout')) active-link @endif"
                           href="{{route('logout')}}">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endauth

@guest()
    <style>
        @media only screen and (min-width: 768px) {
            .navbar-expand-md .navbar-collapse {
                display: flex !important;
                flex-basis: auto;
                padding-left: 345px;
            }
        }

        .navbar-toggler {
            background-color: #2d3748;

        }

        .custom-toggler .navbar-toggler-icon {
            background-image: url(
            "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23fff' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

    </style>
    <nav class="navbar navbar-expand-md front-nav">
        <div class="container-fluid">
            <a class="navbar-brand d-md-none" href="#">
                <img src="{{asset('images/Logo2.png')}}" alt="" class="img-fluid" style="width: 175px">
            </a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">

                <ul class="navbar-nav">
                    <a class="navbar-brand d-none d-md-block" href="#">
                        <img src="{{asset('images/Logo2.png')}}" alt="" class="img-fluid" style="width: 150px">
                    </a>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('participation.index')) active-link @endif"
                           href="{{route('participation.index')}}">COMO PARTICIPAR</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('displayStaticPage','regulamento')) active-link @endif"
                           href="{{route('displayStaticPage','regulamento')}}">REGULAMENTO</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('logout')) active-link @endif"
                           href="{{route('login')}}">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

@endguest
