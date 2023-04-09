<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmailOtp extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'verifycode',
        'expire_at',
    ];
}
