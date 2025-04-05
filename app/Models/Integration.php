<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = [
        'platform',
        'shop_name',
        'access_token',
        'refresh_token',
        'token_expires_at',
        'user_id',
    ];

    protected $dates = ['token_expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if token is expired
    public function isTokenExpired()
    {
        return $this->token_expires_at && $this->token_expires_at->isPast();
    }

    // Optional: auto-refresh logic
    public function needsRefresh()
    {
        return $this->token_expires_at && $this->token_expires_at->diffInMinutes(now()) < 5;
    }
}
