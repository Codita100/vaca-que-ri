@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users Table</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i
                            class="fas fa-shield-alt"></i>Create Permission</a>

                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>

                        <th class="text-danger">Email</th>
                        <th class="text-danger">Rol</th>
                        <th class="text-danger">Edit</th>
                        <th class="text-danger">Delete</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{ $user->email }}
                                </div>
                            </td>

                            <td>
                                <div class="flex items-center">
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-dark">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <div class="flex justify-end">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                           class="btn btn-warning">View User</a>

                                    </div>
                                </div>
                            </td>


                            <td>
                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@stop
