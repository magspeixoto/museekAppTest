<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@museek.com',
            'password' => bcrypt('admin'), // Use a senha que desejar
        ]);

        $admin->assignRole('admin'); // Atribui a função de administrador ao usuário
    }
}
