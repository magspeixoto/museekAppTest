<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        return inertia(
            'Categories/Index',
            [
                'categories' => Category::paginate(5),
            ]
        );
    }

    public function show(Category $category)
    {
        return inertia(
            'Categories/Show',
            [
                'category' => $category
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

        // Invalidate the cache
        Cache::forget('categories.all');

        // Optionally, you can return a response or redirect
        return redirect()->route('category.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        return inertia('Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update(
            $request->validate([
                'name' => 'required|min:0|max:200'
            ])
        );

        // Invalidate the cache
        Cache::forget('categories.all');

        return redirect()->route('category.index')
            ->with('success', 'Category was updated!');
    }

    public function destroy(Request $request, Category $category)
    {
        $currentPage = $request->input('page', 1);
        $category->delete();

        // Invalidate the cache
        Cache::forget('categories.all');

        // Check if the current page is empty after deletion
        $categories = Category::paginate(10, ['*'], 'page', $currentPage);
        if ($categories->isEmpty() && $currentPage > 1) {
            $currentPage--;
        }

        // Redirect to the same (or previous) page with a flash message
        return redirect()->route('category.index', ['page' => $currentPage])
            ->with('success', 'Categoria eliminada com sucesso!');
    }
}
