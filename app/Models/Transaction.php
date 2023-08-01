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

    public function user(){
        //parameter
                                            //2nd unique id sa appointment table 
                                                //3rd  unique id sa user table
        return $this->belongsTo(User::class, 'user_id', 'id'); // select * from user where 
        // return $this->hasMany(User::class, 'id', 'user_id');
    }

    public static function getBilling(){
        return self::distinct()->select('transno', 'user_id', 'fullname', 'sub_total', 'status', 'total' )->latest('created_at')->get();
    }
}
