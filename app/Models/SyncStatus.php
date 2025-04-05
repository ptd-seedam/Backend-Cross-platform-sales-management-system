<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncStatus extends Model
{
    protected $fillable = [
        'product_id', 'channel', 'synced', 'last_synced_at', 'error_message',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
