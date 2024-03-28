@extends('layouts.app')
@section('content')
    <div class="container my-container">
        <h3>Email templates</h3>
        <div class="row">
            <div class="col-md-4">
                <a href="{{route('email.create')}}" class="btn btn-warning">Add new email template</a>
            </div>
        </div>
        <div class="row my-5">
            <table class="display" id="tabel"
                   style="width:100%; background-color: #ffffff; color: black;">
                <thead style="background-color: black; color: white !important;">
                <th>Email name</th>
                <th>Subject</th>
                <th>Send to</th>
                <th>Edit</th>
                </thead>
                <tbody>
                @foreach($values as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->subject}}</td>
                        <td>{{$value->type}}</td>
                        <td><a href="{{route('email.edit', $value->id)}}" class="btn btn-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('after_js')
    <script>
        $(document).ready(function () {
            $('#tabel').DataTable();
        });
    </script>
@endsection
