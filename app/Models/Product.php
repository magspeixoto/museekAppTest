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
        'price',
        'description',
        'brand',
        'category'
    ];

    // 1 Product BelongsTo a category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }
    // 1 Product BelongsTo a brand
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand');
    }
    // 1 Product BelongsTo a order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'product');
    }
    // 1 Product can have many images
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    // 1 Product can have one image associated
    public function mainImage()
    {
        return $this->hasOne(Image::class)->where('main', true);
    }
    /* function that gets the URL of the image. The function is a custom attribute accessor, 
    which is used to dynamically retrieve the URL of the main image associated with the model. */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->mainImage;
        return $mainImage ? asset('storage/' . $mainImage->imageURL) : null;
    }
}
