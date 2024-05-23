<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return inertia(
            'Categories/Index',
            [
                'categories' => Category::all(),
            ]
        );
    }
    
    public function show(Category $category)
    {
        return inertia(
            'Categories/Show',
            [
                'category'=> $category
            ]
        );
    }
    public function create()
    {
        return inertia(
            'Categories/Create',
        );
    }
    public function store(Request $request)
{
    Category::create(
        $request->validate([
            'name' => 'required',
        ])
        );

        // Optionally, you can return a response or redirect
        return redirect()->route('category.index')->with('success', 'Brand was created!');
}

    public function edit(Category $category)
    {
        return inertia('Categories/Edit',[
            'category'=> $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update(
            $request->validate([
                'name' => 'required|min:0|max:200'])
        );

        return redirect()->route('category.index')
            ->with('success', 'Brand was updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Brand was deleted!');
    }
}
