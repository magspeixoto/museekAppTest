<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

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
    public function index2($categoryId)
    {
        // Fetch the category by its ID
        $category = Category::find($categoryId);
        $products = Product::with('mainImage')->where('category', $categoryId)->get()->map(function ($product) {
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

        return Inertia::render('Index/Index2', [
            'category' => $category,
            'products' => $products,
        ]);
    }
    public function show(Product $product)
    {
        $product->load('mainImage'); // Ensure the main image relationship is loaded

        return inertia('Products/Show', [
            'categories' => Category::all(),
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category_id,
                'brand' => $product->brand_id,
                'image' => $product->main_image_url, // Include the image URL
            ],
        ]);
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return Inertia::render('Products/Create', ['categories' => $categories, 'brands' => $brands]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request including the image file
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Remove 'image' from $validatedData to avoid inserting it into the products table
        $productData = $validatedData;
        unset($productData['image']);

        // Create the product first
        $product = Product::create($productData);

        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('images', 'public');

            // Save the image details in the images table
            Image::create([
                'imageURL' => $imagePath,
                'original_name' => $imageFile->getClientOriginalName(),
                'main' => true, // Assuming this is the main image for the product
                'product_id' => $product->id,
            ]);
        }

        // Optionally, you can return a response or redirect
        return redirect()->route('product.index')->with('success', 'Product was created!');
    }

    public function edit(Product $product)
    {
        $product->load('mainImage');
        $categories = Category::all();
        $brands = Brand::all();
        return inertia('Products/Edit', [
            'product' => $product,
            'imageUrl' => $product->mainImage ? Storage::url($product->mainImage->imageURL) : null,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function update(Request $request, Product $product)
    {
        // Validate the incoming request including the image file
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update product details
        $product->update($validatedData);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->mainImage) {
                Storage::disk('public')->delete($product->mainImage->imageURL);
            }

            // Store the new image
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('images', 'public');

            // Update the image details in the images table
            $product->images()->updateOrCreate(
                ['main' => true], // Assuming the main image should be updated
                [
                    'imageURL' => $imagePath,
                    'original_name' => $imageFile->getClientOriginalName(),
                    'main' => true,
                ]
            );
        }

        return redirect()->route('product.index')->with('success', 'Product was updated!');
    }

    public function uploadImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Delete the old image if it exists
        if ($product->mainImage) {
            Storage::disk('public')->delete($product->mainImage->imageURL);
        }

        // Store the new image
        $imageFile = $request->file('image');
        $imagePath = $imageFile->store('images', 'public');

        // Update the image details in the images table
        $product->images()->updateOrCreate(
            ['main' => true], // Assuming the main image should be updated
            [
                'imageURL' => $imagePath,
                'original_name' => $imageFile->getClientOriginalName(),
                'main' => true,
            ]
        );

        return redirect()->route('product.index')->with('success', 'Image was updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'product was deleted!');
    }

}
