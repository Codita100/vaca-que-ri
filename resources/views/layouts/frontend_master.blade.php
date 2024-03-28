<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Vaca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{asset('css/frotend-custom.css')}}"/>
</head>

<body>

<nav class="navbar navbar-expand-md front-nav">
    <div class="container-fluid">
        <a class="navbar-brand d-md-none" href="#">
            <img src="{{asset('images/Logo.jpg')}}" alt="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('account.index')}}">PERFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('accumulate.index')}}">DADOS DE ENVIO</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('transactions.index')}}">CONDIGOS</a>
                </li>

                <a class="navbar-brand d-none d-md-block" href="#">
                    <img src="{{asset('images/Logo.jpg')}}" alt="" class="img-fluid">
                </a>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('participation.index')}}">COMO PARTICIPAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('displayStaticPage','regulament')}}">REGULAMENTO</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@include('layouts.errors')
@yield('content-frontend')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>





