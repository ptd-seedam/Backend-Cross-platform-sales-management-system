<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'channel', 'customer_id', 'total_price', 'status', 'created_at'];

    // Relationship with Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // Relationship with OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
