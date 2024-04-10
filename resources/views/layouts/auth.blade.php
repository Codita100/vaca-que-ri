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
    }

    .max-height-image {
        max-height: 100vh;
        width: auto;
    }
</style>

<body>
@include('layouts.errors')

<div class="row">
    <div class="col-md-5">
        <img src="{{asset('images/bg-login.jpg')}}" class="img-fluid max-height-image"
             style="object-fit: cover;">
    </div>

    <!-- Login -->
    <div class="col-md-6 d-flex align-items-center">

            @yield('auth')

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>





