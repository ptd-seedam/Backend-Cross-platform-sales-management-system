<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'role_id'];

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship with StoreEmployee
    public function storeEmployees()
    {
        return $this->hasMany(StoreEmployee::class);
    }

    // Relationship with Salary
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}