<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'url', 'alt_text'];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}