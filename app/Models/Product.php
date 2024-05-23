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
        return $this->belongsTo(Category::class, 'category');
    }
    public function brand():BelongsTo{
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function order():BelongsTo{
        return $this->belongsTo(Order::class, 'order');
    }
   
    public function images():HasMany{
       return $this->hasMany(Product::class, 'image');
   }
}
