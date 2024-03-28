@extends('layouts.app')
@section('content')
    <div class="card px-3">
        <div class="card-header">
            <h3 class="card-title">User</h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-primary">Users Index</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row my-2">
                <div class="col-md-12">
                    <div class="flex flex-col  bg-slate-100">
                        <div> Email: {{ $user->email }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-2xl font-semibold">Roles</h3>
                    <div class="container">
                        <div class="row">
                            @if ($user->roles)
                                @foreach ($user->roles as $user_role)
                                    <div class="col-auto">
                                        <form method="POST"
                                              action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-warning">{{ $user_role->name }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                        @csrf
                        <div>
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
                            class="btn btn-success">Assign the role
                    </button>
                </div>
                </form>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <h3 class="text-2xl font-semibold">Permissions</h3>
                    <div class="container">
                        <div class="row">

                            @if ($user->permissions)
                                @foreach ($user->permissions as $user_permission)
                                    <div class="col-auto">
                                        <form method="POST"
                                              action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-warning">{{ $user_permission->name }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                        @csrf
                        <div>
                            <label for="permission" class="block text-sm font-medium text-gray-700">Permission</label>
                            <select id="permission" name="permission" autocomplete="permission-name"
                                    class="form-control">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('permission')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-success">Assign the permission</button>
                </div>
                </form>
            </div>
            <div class="row p-2">
                <div class="col-md-12">
                    <p>Note! If the user has a role that include this permission, can not be assigned anymore.</p>
                </div>
            </div>
        </div>

    </div>

@stop
