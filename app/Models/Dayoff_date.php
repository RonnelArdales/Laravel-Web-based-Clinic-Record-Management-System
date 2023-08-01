<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dayoff_date extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'dayoff_dates';

    public static function getDayoff_date(){
         $dates = self::select('date')->get();
         return $dates;
    }
}
