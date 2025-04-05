<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $fillable = [
        'name',
        'located'
    ];
    public function inventoris(){
        return $this->hasMany(Warehouse::class, 'warehouse_id', 'id');
    }
}
