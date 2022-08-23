@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center">{{ __($product->title) }}</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            @if(Storage::has($product->thumbnail))
                <img src="{{ $product->thumbnailUrl }}" class="card-img-top"
                     style="width: 200px; height: 300px; margin: 0 auto; display: block;">
            @endif
        </div>
        <div class="col-md-6">
            <p>Price: {{ $product->end_price }}$</p>
            <p>SKU: {{ $product->SKU }}</p>
            <p>In stock: {{ $product->in_stock }}</p>
            <hr>
            <div>
                <p>Product Category: <b> @include('categories.parts.category_view', ['category' => $product->category])</b></p>
            </div>
            @if($product->in_stock > 0)
                <hr>
                <div>
                    <p>Add to Cart: </p>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="form-inline">
                        @csrf
                        @method('post')
                        <div class="form-group col-sm-3 mb-2">
                            <label for="product_count" class="sr-only">Count: </label>
                            <input type="number"
                                   name="product_count"
                                   class="form-control"
                                   id="product_count"
                                   min="1"
                                   max="{{ $product->in_stock }}"
                                   value="1"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Buy</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="col-md-10 text-center">
            <h4>Description: </h4>
            <p>{{ $product->description }}</p>
        </div>
    </div>
    <hr>
@endsection
