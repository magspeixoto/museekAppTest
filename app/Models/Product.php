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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'product');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function mainImage()
    {
        return $this->hasOne(Image::class)->where('main', true);
    }

    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->mainImage;
        return $mainImage ? asset('storage/' . $mainImage->imageURL) : null;
    }
}
