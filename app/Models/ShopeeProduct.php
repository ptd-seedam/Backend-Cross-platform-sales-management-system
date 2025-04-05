<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'shopee_product_id', 'price', 'stock'];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}