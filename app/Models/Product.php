<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function shopeeProduct()
    {
        return $this->hasOne(ShopeeProduct::class, 'product_id', 'id');
    }

    public function tiktokProduct()
    {
        return $this->hasOne(TikTokProduct::class, 'product_id', 'id');
    }

    public function syncStatuses()
    {
        return $this->hasMany(SyncStatus::class);
    }

    public function syncStatusFor($channel)
    {
        return $this->syncStatuses()->where('channel', $channel)->first();
    }
}
