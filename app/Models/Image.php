<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageURL', 'original_name', 'main', 'product_id'
    ];

    // 1 Image belongsTo a product
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
