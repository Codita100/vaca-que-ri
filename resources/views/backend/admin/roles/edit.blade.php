@extends('layouts.app')
@section('content')
    <div class="row my-3">
        <div class="col-md-6">
            <a href="{{ route('admin.roles.index') }}"
               class="btn btn-danger"><i class="fas fa-shield-alt"></i> Role Index</a>
        </div>
    </div>

    <div class="container card card-primary p-2">
        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Role name </label>
                    <div class="mt-1">
                        <input type="text" id="name" name="name" value="{{ $role->name }}"
                               class="form-control"/>
                    </div>
                    @error('name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

        <div class="row my-3">
            <div class="col-md-12">
                <label>Role Permissions</label>
                <div class="container">
                    <div class="row">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <div class="col-auto">
                                    <form method="POST"
                                          action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-warning my-1">{{ $role_permission->name }}</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
            @csrf
            <div class="row my-3">
                <div class="col-md-6">
                    <label for="permission" class="block text-sm font-medium text-gray-700">Permission</label>
                    <select id="permission" name="permission" autocomplete="permission-name"
                            class="form-control">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>

                    @error('permission')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </form>
    </div>
@stop
