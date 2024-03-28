@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4><strong> <i class="menu-icon tf-icons ti ti-book"></i>  Add new catalog product</strong></h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.catalogue.store') }}"
                              enctype="multipart/form-data">
                            @csrf



                            <div class="form-group my-1">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="form-group my-1">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" id="stock"
                                       name="stock" value="{{ old('stock') }}" required>
                            </div>


                            <div class="form-group my-1">
                                <label for="points">Points</label>
                                <input type="text" class="form-control" id="points" name="points"
                                       value="{{ old('points') }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="photos">Images</label>
                                <input type="file" class="form-control" id="photos" name="photos[]" accept="image/*" multiple required>
                                <div id="preview-container" class="mt-2"></div>
                            </div>


                            <div class="my-5">
                                <button type="submit" class="btn main_button">Save</button>
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
        });

        function previewImages(input) {
            $('#preview-container').empty(); // Clear previous previews

            if (input.files && input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview-container').append('<img src="' + e.target.result + '" style="max-width: 100px; max-height: 100px; margin-right: 5px;">');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>

@endsection
