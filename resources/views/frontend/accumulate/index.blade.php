@extends('layouts.frontend_master')
<!-- Content -->
@section('content-frontend')

@include('frontend.modals.code_modal')
    <section class="background_second_color py-5 px-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center monstro second_color"><strong>ACCUMULATE POINTS</strong></h3>
                </div>
            </div>
        </div>
    </section>
    <section class="background_second_color">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="{{route('accumulate.store')}}" method="POST">
                        @csrf
                        <div class="my-3">
                            <input type="text" class="form-control custom-input @error('cod') is-invalid @enderror"
                                   id="name" name="cod" value="{{ old('cod')  }}" placeholder="Digite o código aqui.">
                            @error('cod')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn yellow_button d-grid mx-auto monstro">SUBMETER</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

        @include('layouts.frontend.footer2')


@if(session('success_modal'))
    <script>
        $(document).ready(function () {
            $('#codSuccessModal').modal('show');
        });
    </script>
@endif


@if(session('warning_modal'))
    <script>
        $(document).ready(function () {
            $('#codErrorModal').modal('show');
        });
    </script>
@endif

@endsection


