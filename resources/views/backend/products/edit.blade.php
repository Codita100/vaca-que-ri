@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4><strong> <i class="menu-icon tf-icons ti ti-package"></i>Editează Produs</strong></h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group my-1">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" id="quantity"
                                       name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="points">Points</label>
                                <input type="text" class="form-control" id="points" name="points" value="{{ old('points', $product->points) }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="photo">Image</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                <img src="{{ asset('/images/products/' . $product->photo) }}" id="preview" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                            </div>

                            <div class="my-5">
                                <button type="submit" class="btn main_button">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#photo').change(function () {
                previewImage(this);
            });

            function previewImage(input) {
                var preview = $('#preview')[0];

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $(preview).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection
