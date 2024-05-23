<?php

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {Schema::create('product_images', function (Blueprint $table) {
        $table->increments('id');
        $table->foreignIdFor(Product::class, 'product_id')
              ->constrained('products')
              ->onDelete('cascade');
        $table->foreignIdFor(Image::class, 'image_id')
              ->constrained('images')
              ->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            // Drop the foreign keys first
            $table->dropForeign(['product_id']);
            $table->dropForeign(['image_id']);
        });

        // Then drop the table
        Schema::dropIfExists('product_images');
    }
};
