<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return inertia(
            'Products/Index',
            [
                'products' => Product::all(),
            ]
            );
    }
    public function index2 ($category){
        /* $products = Product::where('category_id', $category)->get();
        return Inertia::render('Index/Index2', [
        'products' => $products, */
        $products = Product::with('category')->where('category', $category)->get();
        return Inertia::render('Index/Index2', [
            'products' => $products,
        ]);
    }
    public function show(Product $product)
    {
        return inertia(
            'Products/Show',
            [
                Category::all(),
                'product'=> $product
            ]
        );
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return Inertia::render('Products/Create', ['categories' => $categories, 'brands' => $brands]);
        /* return inertia(
            'Products/Create',
            [
                'categories' => Category::all(),
                'brands' => Brand::all(),
            ] 
        );*/
    }
    public function store(Request $request)
{
    Product::create(
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'image' => '',
        ])
        );

        // Optionally, you can return a response or redirect
        return redirect()->route('product.index')->with('success', 'Product was created!');
}

    public function edit(Product $product)
    {
        return inertia('Products/Edit',[
            'product'=> $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update(
            $request->validate([
                'name' => 'required',
            'image' => '',
            'price'=> 'required|min:1|max:20000',
            'description'=> 'required',
                ])
        );

        return redirect()->route('product.index')
            ->with('success', 'Product was updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'product was deleted!');
    }

}
