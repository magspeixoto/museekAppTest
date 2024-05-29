<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'product',
    ];

    // 1 order hasMany Products relationship
    public function orders():HasMany{
        return $this->hasMany(Product::class, 'product');
    }
}
