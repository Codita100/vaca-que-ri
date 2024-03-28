@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permissions Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i
                        class="fas fa-shield-alt"></i>Create Permission</a>

            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Permission</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                {{ $permission->name }}
                            </div>
                        </td>
                        <td>
                            <div class="flex justify-end">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                       class="btn btn-warning">Edit</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}"
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
