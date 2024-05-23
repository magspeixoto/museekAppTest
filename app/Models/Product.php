<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
    ];
    public function category():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand():BelongsTo{
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
   
    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_images');
    }
}
