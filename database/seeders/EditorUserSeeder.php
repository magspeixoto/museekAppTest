<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     //Creates Editors Seeders
    public function run(): void
    {
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@museek.com',
            'password' => bcrypt('password'), // Use a senha que desejar
        ]);

        $editor->assignRole('editor'); // Atribui a função de editor ao usuário
    }
}
