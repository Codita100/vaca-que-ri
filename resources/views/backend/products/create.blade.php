@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4><strong>  <i class="menu-icon tf-icons ti ti-package"></i> Add new product<strong></strong></h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group my-1">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       required>
                            </div>

                            <div class="form-group my-1">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" id="quantity"
                                       name="quantity" value="{{ old('quantity') }}" required>
                            </div>


                            <div class="form-group my-1">
                                <label for="points">Points</label>
                                <input type="text" class="form-control" id="points" name="points"
                                       value="{{ old('points') }}" required>
                            </div>

                            <div class="form-group my-1">
                                <label for="photo">Image</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                       required>
                                <img src="" id="preview"
                                     style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;">
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
            $('#image').change(function () {
                previewImage(this);
            });
        });

        function previewImage(input) {
            var preview = $('#preview')[0];

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(preview).attr('src', e.target.result);
                    $(preview).css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                $(preview).attr('src', '');
                $(preview).css('display', 'none');
            }
        }
    </script>
@endsection
