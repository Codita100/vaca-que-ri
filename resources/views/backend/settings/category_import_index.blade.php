@extends('layouts.app')


@section('content')
    <div class="container my-container">

        <div class="row">
            @role('super_admin|admin')
            <div class="col-md-12 my-4">
                <form enctype="multipart/form-data" method="post" action="{{ route('farmers.import.cat') }}">
                    @csrf
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <input class="form-control" type="file" id="formFile" name="file">
                            <button type="submit" class="btn main_button mx-5" name="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            @endrole
        </div>
    </div>
@endsection
