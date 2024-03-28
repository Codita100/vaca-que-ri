@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong>Static Pages</strong></h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body my-2">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('pages.create') }}" class="btn btn-success">Add new static page</a>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-md-12">
                    <table id="myTable" class="display"
                           style="width:100%; background-color: #ffffff; color: black;">
                        <thead style="background-color: #2d3748; color: white !important;">
                        <th>Page name</th>
                        <th>Url</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>

                        <tbody>
                        @foreach($values as $value)
                            <tr>
                                <td>{{$value->page_name}}</td>
                                <td>{{$value->url}}</td>
                                <td><a href="{{route('pages.edit', $value->id)}}" class="btn btn-primary">Edit</a></td>
                                <td><a href="{{route('pages.destroy', $value->id)}}" class="btn btn-primary">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after_js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
@endsection
