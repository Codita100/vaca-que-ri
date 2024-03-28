@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles Table</h3>
            <div class="card-tools">

                <a href="{{ route('admin.roles.create') }} " class="btn btn-primary"><i
                        class="fas fa-shield-alt"></i> New Role</a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i=1;
                @endphp
                @forelse ($roles as $role )
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission )
                                <button class="btn btn-warning my-1" role="button"><i
                                        class="fas fa-shield-alt"></i> {{ $permission->name }}</button>
                            @endforeach
                        </td>
                        <td>
                            <span class="tag tag-success">{{ $role->created_at }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                               class="btn btn-warning my-1">Edit</a>
                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td><i class="fas fa-folder-open"></i> No Record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
