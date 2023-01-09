@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">In Stock</th>
                    <th scope="col">Discount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="col">{{ $product->id }}</th>
                        <th scope="col">{{ $product->category_id }}</th>
                        <th scope="col">{{ $product->title }}</th>
                        <th scope="col">{{ $product->SKU }}</th>
                        <th scope="col">Image</th>
                        <th scope="col">{{ $product->price }}</th>
                        <th scope="col">{{ $product->in_stock }}</th>
                        <th scope="col">{{ $product->discount }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection
