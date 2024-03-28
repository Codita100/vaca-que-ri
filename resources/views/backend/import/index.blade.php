@extends('layouts.app')

@section('content')
    <h1>Imports</h1>

    <div class="row my-5">
        <div class="col-md-4">
            <h4>Distribuitors</h4>
            <div class="form-group">
                <form class="addProductForm" enctype="multipart/form-data" method="post" action="{{route('import.distributors')}}">
                    @csrf
                    <div class="col my-2">
                        <label for="myfile">Select a file:</label>
                        <input type="file" id="myfile" name="file">
                    </div>

                    <input type="submit" class="btn btn-warning viliButton" name="submit" value="SAVE">
                </form>
            </div>
        </div>
    </div>
@endsection
