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
        return inertia(
            'Index/Index',
            [
                'categories' => Category::all(),
                'products' => Product::all(),
            ]
        );
    }
    public function show(Product $product)
    {
        // Carregar as relações category e brand
        $product->load(['category', 'brand']);

        return Inertia::render(
            'Index/Show',
            [
                'product' => $product
            ]
        );
    }
}
