<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'description'
    ];
    public function user(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }
    public function employee(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}