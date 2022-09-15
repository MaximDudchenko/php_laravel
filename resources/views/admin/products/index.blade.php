@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">SKU</th>
                    <th scope="col">Price</th>
                    <th scope="col">In Stock</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr id="product-row">
                        <th scope="col">{{ $product->id }}</th>
                        <th scope="col">
                            <img src="{{ $product->thumbnailUrl }}" alt="Preview" width="30" height="50">
                        </th>
                        <th scope="col">
                            <a href="#">
                                {{ $product->category->name }}
                            </a>
                        </th>
                        <th scope="col">{{ $product->title }}</th>
                        <th scope="col">{{ $product->SKU }}</th>
                        <th scope="col">{{ $product->price }}</th>
                        <th scope="col">{{ $product->in_stock }}</th>
                        <th scope="col">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-secondary form-control">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger form-control" value="Delete">
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection

