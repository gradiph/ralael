<?php

namespace App\Http\Controllers\Admin\Master;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.master.category.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }

    public function dataList(Request $request)
    {
        $categories = Category::get();

        return view('admin.master.category.list')->with([
            'categories' => $categories,
        ]);
    }
}
