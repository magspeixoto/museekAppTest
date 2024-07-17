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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // First, seed roles and permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Then seed admin and editor users
        $this->call(AdminUserSeeder::class);
        $this->call(EditorUserSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test12345@example.com',
        ]);
        // Create a category first
        $category = Category::factory()->create();

        // Create a brand
        $brand = Brand::factory()->create();
        Product::factory()->create([
            'name' => 'Test Product',
            'price' => '1200',
            'description'=> 'hello world',
            'category' => $category->id,
            'brand' => $brand->id,
        ]);
    }
}
