@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit the product</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.catalogue.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group my-1">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="points">Points</label>
                                <input type="text" class="form-control" id="points" name="points" value="{{ old('points', $product->points) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="photos">Images</label>
                                <input type="file" class="form-control" id="photos" name="photos[]" accept="image/*" multiple>

                                <div id="image-preview" class="mt-2">
                                    @foreach($product->multiImages as $image)
                                        <img src="{{ asset('/images/products_catalogue/' . $image->photo) }}" class="preview-image" style="max-width: 100px; max-height: 100px; margin-right: 5px;">
                                    @endforeach
                                </div>
                            </div>

                            <div class="my-5">
                                <button type="submit" class="btn main_button">Update the product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#photos').change(function () {
                previewImages(this);
            });

            function previewImages(input) {
                $('#image-preview').empty(); // Clear previous previews

                if (input.files && input.files.length > 0) {
                    for (var i = 0; i < input.files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#image-preview').append('<img src="' + e.target.result + '" class="preview-image" style="max-width: 100px; max-height: 100px; margin-right: 5px;">');
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            }
        });
    </script>
@endsection
