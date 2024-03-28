@extends('layouts.app')
@section('content')
    <div class="card card-primary p-5">
        <div class="col-md-12">
            <h4>Create new role</h4>
        </div>

        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="row my-2">
                <div class="col-md-8">
                    <label for="name"> Role name </label>
                    <input type="text" id="name" name="name" class="form-control"/>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i>
                        See all
                        Roles</a>
                </div>
            </div>
        </form>
    </div>
@stop



