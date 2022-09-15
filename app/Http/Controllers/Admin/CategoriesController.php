<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ImagesStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $category = new Category($request->validated());
            $category->save();

            DB::commit();

            return redirect()->route('admin.categories.index')->with('status', 'The category was successfully created!');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->back()->with('warn', 'Category not created. See logs');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin/categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();

            $category->update($request->validated());

            DB::commit();

            return redirect()->route('admin.categories.index')->with('status', 'The category was successfully update!');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->back()->with('warn', 'Category not updated. See logs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();

            return redirect()->route('admin.categories.index')->with('status', 'The category was successfully removed!');
        } catch (Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return redirect()->route('admin.categories.index')->with('warn', 'Category not removed. See logs');
        }
    }
}
