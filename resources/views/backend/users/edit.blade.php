@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="d-flex align-content-center flex-wrap gap-2">
            <a href="{{route('users.index')}}" class="btn btn-label-danger delete-order waves-effect">Back</a>
        </div>
    </div>

    <div><h4>Edit - {{$user->name}} {{$user->email}}</h4></div>
    <div class="row">
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @csrf
            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $user->name) }}" class="form-control">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 my-1">
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"
                               value="{{ old('email', $user->email) }}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div>
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone"
                               value="{{ old('phone', $user->address ? $user->address->phone : '' ) }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address"
                               value="{{ old('address', $user->address ?  $user->address->address :  '') }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div>
                        <label for="city">City</label>
                        <input type="text" id="city" name="city"
                               value="{{ old('city', $user->address ? $user->address->city : '') }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3 my-1">
                    <div>
                        <label for="postal">Postal Code</label>
                        <input type="text" id="postal" name="postal"
                               value="{{ old('postal', $user->address ? $user->address-> postal : '') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-3 my-1">
                    <div>
                        <label for="code">Postal Code</label>
                        <input type="text" id="code" name="code"
                               value="{{ old('code', $user->address ? $user->address-> code : '') }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6 my-1">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="active" name="active"
                            {{ $user->email_verified_at ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Activ</label>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mt-5">
                <button type="submit" class="btn main_button">
                    <span>Save</span>
                </button>
            </div>
        </form>
    </div>
@endsection
