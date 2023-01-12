@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Cart') }}</h3>
            </div>
            <div class="col-md-12">
                @if(Cart::instance('cart')->count() > 0)
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>

                        @each('cart.parts.product_view', Cart::instance('cart')->content(), 'row')

                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">There are no products in cart</h3>
                @endif
                <hr>
                <table class="table table-light text-center">
                    <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>{{ Cart::instance('cart')->subtotal() }}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>{{ Cart::instance('cart')->tax() }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>{{ Cart::instance('cart')->total() }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @auth
            <div class="col-md-12 text-right">
                <a href="{{ route('checkout') }}" class="btn btn-outline-success">{{ __('Proceed to checkout') }}</a>
            </div>
        @endauth
    </div>
@endsection
