<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Services\FileStorageService;
use App\Services\ImagesStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(20);

        return view('admin/products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin/products/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $images = $data['images'] ?? [];
            $category = Category::find($data['category']);
            $product = $category->products()->create($data);
            ImagesStorageService::attach($product, 'images', $images);

            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'The product was successfully created!');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->back()->with('warn', 'Product not created. See logs');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin/products/edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->update($request->validated());
            ImagesStorageService::attach($product, 'images', $request->images ?? []);

            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'The product was successfully update!');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->back()->with('warn', 'Product not updated. See logs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();
            $product->images()->delete();

            DB::commit();

            return redirect()->route('admin.products.index')->with('status', 'The product was successfully created!');
        } catch (Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->route('admin.products.index')->with('warn', 'Error');
        }
    }
}
