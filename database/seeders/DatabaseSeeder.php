<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Product::factory()->create([
            'name' => 'Test Product',
            'image' => 'fqerfqe',
            'price' => '1200',
            'description'=> 'hello world',
        ]);

        Brand::factory(5)->create([
            'name' => 'Test User',
        ]);
        Category::factory(5)->create([
            'name' => 'Test User',
        ]);
        

        
    }
}
