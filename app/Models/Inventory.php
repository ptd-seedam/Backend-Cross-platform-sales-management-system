<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = [
        'product_id',
        'warehouse_id'
    ];
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}