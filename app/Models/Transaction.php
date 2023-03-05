<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    //     public function setConsultation_dateAttribute( $value ) {
    //     $this->attributes['consultation_date'] = Carbon::createFromFormat('m-d-Y h:i A', $value)->format('Y-MM-DD HH:mm:ss');

    //   }
}
