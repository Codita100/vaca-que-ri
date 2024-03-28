@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('pages.update', $value->id) }}">
                @csrf
                <label for="page_name">Page name</label>
                <input type="text" name="page_name" class="form-control" value="{{ $value->page_name }}">
                @error('page_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="url">URL Page</label>
                <input type="text" name="url" class="form-control" value="{{ $value->url }}">
                @error('url')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="page_content">Content</label>
                <textarea name="page_content" class="form-control" id="editor">{{ $value->page_content }}</textarea>
                @error('page_content')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="form-control btn-success">Update page</button>
            </form>
        </div>
    </div>
@endsection

@section('after_js')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

