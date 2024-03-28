@extends('layouts.app')
@section('content')
    <div class="container my-container">
        <div class="col-md-12">
            <h4>Profilul meu</h4>
        </div>
    </div>


    <form method="post" action="">
        @csrf

        <div class="row my-3">
            <div class="col-md-4">
                <label for="lastname">Nume</label>
                <input type="text" id="lastname" name="lastname"
                       value="{{ $user->lastname }}" placeholder="Nume"
                       class="form-control">
                @error('lastname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="lastname">Prenume</label>
                <input type="text" id="lastname" name="lastname"
                       value="{{ $user->lastname }}" placeholder="Prenume"
                       class="form-control">
                @error('firstname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-4">
                <div class="d-flex flex-column h-100">
                    <button type="submit" class="btn main_button flex-grow-1">
                        <span>Salvează</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
