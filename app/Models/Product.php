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

    public function order():BelongsTo{
        return $this->belongsTo(Order::class, 'order_id');
    }
   
    public function images():HasMany{
       return $this->hasMany(Product::class, 'image_id');
   }
}
