<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservationfee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reservationfees';

    public static function getReservationfee(){
        return self::select('reservationfee')->first();

    }
}
