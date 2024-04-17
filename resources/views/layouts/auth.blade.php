<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>A vaca que ri</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{asset('css/frotend-custom.css')}}"/>
</head>
<style>
    body {
        overflow-x: hidden;
        background-color: #FABE55;
    }

</style>

<body>
@include('layouts.errors')

<div class="row" >

    <!-- Login -->
    <div class="col d-flex align-items-center background_main_color order-md-2">
        @yield('auth')
    </div>

    <div class="col-md-5 p-0  order-md-1">
        <img src="{{asset('images/bg-login.jpg')}}" class="img-fluid h-100 d-md-block d-none" alt="Imagine">
        <img src="{{asset('images/bg-login.jpg')}}" class="img-fluid d-md-none" alt="Imagine">
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>





