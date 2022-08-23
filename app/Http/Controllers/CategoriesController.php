<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->withCount('products')
            ->having('products_count', '>', '0')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products()->paginate(10);

        return view('categories.show', compact('category', 'products'));
    }
}
