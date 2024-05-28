<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return inertia(
            'Brands/Index',
            [
                'brands' => Brand::paginate(5),
            ]
        );
    }

    public function show(Brand $brand)
    {
        return inertia(
            'Brands/Show',
            [
                'brand' => $brand
            ]
        );
    }
    public function create()
    {
        return inertia(
            'Brands/Create',
        );
    }
    public function store(Request $request)
    {
        Brand::create(
            $request->validate([
                'name' => 'required',
            ])
        );

        // Optionally, you can return a response or redirect
        return redirect()->route('brand.index')->with('success', 'Marca criada com sucesso!');
    }

    public function edit(Brand $brand)
    {
        return inertia('Brands/Edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update(
            $request->validate([
                'name' => 'required|min:0|max:200'
            ])
        );

        return redirect()->route('brand.index')
            ->with('success', 'Marca editada com sucesso!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brand.index')
            ->with('success', 'Marca eliminada com sucesso!');
    }
}
