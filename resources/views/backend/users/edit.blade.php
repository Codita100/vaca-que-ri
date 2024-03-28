@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="d-flex align-content-center flex-wrap gap-2">
            <a href="{{route('users.index')}}" class="btn btn-label-danger delete-order waves-effect">Inapoi</a>
        </div>
    </div>

    <div><h4>Editeaza user - {{$salesForce->firstname}} {{$salesForce->lastname}}</h4></div>
    <div class="row">
        <form method="post" action="{{ route('users.update', $salesForce->id) }}">
            @csrf
            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div>
                        <label for="firstname">Nume</label>
                        <input type="text" id="firstname" name="firstname"
                               value="{{ old('firstname', $salesForce->firstname) }}" class="form-control">
                        @error('firstname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 my-1">
                    <div>
                        <label for="lastname">Prenume</label>
                        <input type="text" id="lastname" name="lastname"
                               value="{{ old('lastname', $salesForce->lastname) }}" class="form-control">
                        @error('lastname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"
                               value="{{ old('email', $salesForce->email) }}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-md-6 mt-5">
                <button type="submit" class="btn main_button">
                    <span>Salveaza</span>
                </button>
            </div>
        </form>
    </div>
@endsection
