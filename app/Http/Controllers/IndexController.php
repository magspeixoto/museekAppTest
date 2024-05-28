<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::with('mainImage')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category,
                'brand' => $product->brand,
                'image' => $product->main_image_url, // Include the image URL
            ];
        });       

        return inertia(
            'Index/Index',
            [
                'categories' => Category::all(),
                'products' => $products,
            ]
        );
    }
    public function show(Product $product)
    {
        // Load the category, brand, and mainImage relationships
        $product->load(['category', 'brand', 'mainImage']);

        return Inertia::render(
            'Index/Show',
            [
                'product' => $product
            ]
        );
    }
}
