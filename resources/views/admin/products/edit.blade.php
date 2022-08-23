@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $product->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id === $product->category->id ? 'selected' : '' }}
                                            >{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="SKU" class="col-md-4 col-form-label text-md-end">{{ __('SKU') }}</label>

                                <div class="col-md-6">
                                    <input id="SKU" type="text" class="form-control @error('SKU') is-invalid @enderror" name="SKU" value="{{ $product->SKU }}" required autocomplete="SKU" autofocus>

                                    @error('SKU')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" autofocus>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>

                                <div class="col-md-6">
                                    <input id="discount" type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $product->discount }}" required autocomplete="discount" autofocus>

                                    @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="in_stock" class="col-md-4 col-form-label text-md-end">{{ __('In Stock') }}</label>

                                <div class="col-md-6">
                                    <input id="in_stock" type="number" class="form-control @error('in_stock') is-invalid @enderror" name="in_stock" value="{{ $product->in_stock }}" required autocomplete="in_stock" autofocus>

                                    @error('in_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required cols="30" rows="10">
                                        {{ $product->description }}
                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_description" class="col-md-4 col-form-label text-md-end">{{ __('Short description') }}</label>

                                <div class="col-md-6">
                                    <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" cols="30" rows="10">
                                        {{ $product->short_description }}
                                    </textarea>

                                    @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-end">{{ __('Thumnail') }}</label>
                                <div class="col-md-6">
                                    <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail') }}">
                                </div>

                                @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3 d-flex justify-content-center">
                                <div class="col-md-6">
                                    <img src="{{ $product->thumbnailUrl }}" id="thumbnail-preview" class="" alt="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Images') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                </div>
                            </div>

                            <div class="row mb-3 d-flex justify-content-center">
                                <div class="col-md-6">
                                    <div class="images-wrapper">
                                        @foreach($product->images as $image)
                                            @if (Storage::has($image->path))
                                                <div class="col-sm-12 d-flex justify-content-center align-items-center">
                                                    <img src="{{ $image->url }}" class="card-img-top" style="max-width: 50%; margin: 0 auto; display: inline-block;">
                                                    <a class="btn btn-outline-danger remove-product-image" data-route="{{ route('ajax.images.delete', $image->id) }}">Delete</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __(' Update ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @vite(['resources/js/images-preview.js', 'resources/js/images-actions.js'])
@endsection
