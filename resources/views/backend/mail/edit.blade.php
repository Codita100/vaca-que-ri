@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('email.update', $value->id)}} " method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Email name</label>
                        <input type="text" name="name" class="form-control" placeholder="Nume email" value="{{ $value->name }}" disabled>

                        <label for="subject">Email subject to client</label>
                        <input type="text" name="subject" class="form-control" placeholder="Email subject to client" value="{{ $value->subject }}">

                    </div>

                    <div class="col-md-6">
                        <label for="type">Type</label>
                        <input type="text" name="type" class="form-control" placeholder="Type" value="{{ $value->type }}">
                    </div>
                    <hr class="mt-4">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="description">Email content</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Email content - can contain html">{{ $value->description }}</textarea>

                        <button type="submit" class="form-control btn-success">Update template</button>
                        @csrf
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
