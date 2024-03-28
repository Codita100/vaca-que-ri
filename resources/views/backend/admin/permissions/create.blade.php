@extends('layouts.app')
@section('content')
    <div class="card card-primary p-5">
        <div class="col-md-12">
            <h4>Create new permission</h4>
        </div>

        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="row my-2">
                <div class="col-md-8">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Post name </label>
                    <input type="text" id="name" name="name" class="form-control"/>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger">See all Permissions</a>
                </div>
            </div>
        </form>
    </div>
@stop

