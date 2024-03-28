@extends('layouts.app')
@section('content')

    @include('layouts.errors')

    <div class="container">
        <div class="row my-3">
            <div class="col-md-6">
                <a href="{{ route('admin.permissions.index') }}"
                   class="btn btn-danger"><i class="fas fa-shield-alt"></i> Permission Index</a>
            </div>
        </div>

        <div class="container card card-primary p-2">
            <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="block text-sm font-medium text-gray-700"> Permission name
                        </label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ $permission->name }}"/>
                        </div>
                        @error('name')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit"
                                class="btn btn-primary">Update
                        </button>
                    </div>
                </div><!--end row-->
            </form>
            <div class="row my-2">
                <div class="col-md-12">
                    <label>Role Permissions</label>
                    <div class="container">
                        <div class="row">
                            @if ($permission->roles)
                                @foreach ($permission->roles as $permission_role)
                                    <form method="POST"
                                          action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-warning m-1">{{ $permission_role->name }}</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>


        <div class="container card card-primary p-2">
            <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                        <select id="role" name="role" autocomplete="role-name"
                                class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('role')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit"
                            class="btn btn-primary my-2">Assign
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop







