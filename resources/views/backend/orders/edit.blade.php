@extends('layouts.app')

@section('content')

    <div class="container my-container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h4>
                        <strong>
                            <i class="menu-icon tf-icons ti ti-shopping-cart"></i> Editeaza order - {{$order->id}}
                        </strong>
                    </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <form method="post" action="{{ route('order.update', $order->token) }}">
                @csrf

                <div class="col-md-6 mt-5">
                    <div class="form-group">
                        <label for="product_id">Selectează produsul nou:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            @foreach($products as $product)
                                <option value="{{$product->id}}" @if($product->id == $order->product_catalogs_id) selected @endif>{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-5">
                    <button type="submit" class="btn main_button">
                        <span>Salveaza</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
