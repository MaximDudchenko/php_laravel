@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="col">{{ $category->id }}</th>
                        <th scope="col">{{ $category->name }}</th>
                        <th scope="col">{{ $category->description }}</th>
                        <th scope="col">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-secondary form-control">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger form-control" value="Delete">
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection

