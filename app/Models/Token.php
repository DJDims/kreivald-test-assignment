<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'token',
        'expires_at',
        'is_used'
    ];
}
