@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')
    <section class="background_second_color my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="main_color text-center"><strong>ACCUMULATE POINTS</strong></h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="{{route('accumulate.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cod" class="form-label">Introdu codul</label>
                            <input type="text" class="form-control" id="cod" placeholder="Introdu textul aici" name="cod">
                        </div>

                        <button type="submit" class="btn main_button">Trimite</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
