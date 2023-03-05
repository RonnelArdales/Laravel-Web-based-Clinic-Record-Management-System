<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    // public function setDateAttribute( $value ) {
    //     $this->attributes['date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');

    //   }

      public function getDateAttribute($value)
{
    return Carbon::parse($value)->format('m/d/Y');
}

public function getTimeAttribute($value)
{
    return Carbon::parse($value)->format('h:i A');
}
}
