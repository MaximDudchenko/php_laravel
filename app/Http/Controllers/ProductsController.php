<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $userRating = $product->getUserRating();
        $rating = is_null($userRating) ? 0 : $userRating->rating;

        return view('products.show', compact('product', 'rating'));
    }

    public function addRating(Request $request, Product $product)
    {
        $product->rateOnce($request->get('star'));

        return redirect()->back();
    }
}
