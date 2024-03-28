@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-container">
            <div><h4><strong> <i class="menu-icon tf-icons ti ti-package"></i> Products </strong></h4>
            </div>

            <div class="col-md-2 my-4">
                <a href="{{ route('product.create')}}" class="btn main_button">Add product</a>
            </div>

            <div class="row my-5">
                <table id="myTable" class="display"
                       style="width:100%; background-color: #ffffff; color: black;">
                    <thead style="background-color: #2d3748; color: white !important;">
                    <th>#</th>
                    <th>Name</th>
                    <th>Qunatity</th>
                    <th>Points</th>
                    <th>Photo</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

                    @php
                        {{$i=1;}}
                    @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->points}}</td>
                            <td><img src="{{ asset('images/products/' . $product->photo) }}" alt="Product Image"
                                     style="max-width: 100px; max-height: 100px;"></td>
                            <td>
                                <a class="btn  btn-icon btn-warning waves-effect waves-light"
                                   href="{{route('product.edit', $product->id)}}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a class="btn btn-icon btn-danger waves-effect waves-light"
                                   href="{{ route('product.delete', $product->id) }}"
                                   onclick="return confirm('Are you sure you watn to delete this product?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('after_js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
@endsection
