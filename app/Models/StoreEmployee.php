<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreEmployee extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'employee_id'];

    // Relationship with Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
