<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Obter o arquivo da requisição
        $imageFile = $request->file('image');
    
        // Definir o nome da imagem com base no timestamp atual
        $imageName = time().'.'.$imageFile->extension();
    
        // Mover o arquivo para o diretório de armazenamento de imagens
        $imageFile->move(public_path('images'), $imageName);
    
        // Salvar o caminho da imagem no banco de dados
        $image = new Image();
        $image->imageURL = '/images/' . $imageName; // Ou o caminho correto onde as imagens são armazenadas
        $image->save();
    
        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
