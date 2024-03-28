@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('email.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Email name</label>
                        <input type="text" name="name" class="form-control" placeholder="Email name">

                        <label for="subject">Email subject to client</label>
                        <input type="text" name="subject" class="form-control" placeholder="Email subject to client">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="description">Email content</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Email content - can contain HTML"></textarea>

                        <button type="submit" class="form-control btn-success">Add template</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('after_js')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
