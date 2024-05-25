<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);

        // Salve o caminho da imagem no banco de dados, por exemplo:
        // Image::create(['path' => '/images/'.$imageName]);

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
