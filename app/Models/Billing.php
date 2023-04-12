<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        //parameter
                                            //2nd unique id sa appointment table 
                                                //3rd  unique id sa user table
        return $this->belongsTo(User::class, 'user_id', 'id'); // select * from user where 
        // return $this->hasMany(User::class, 'id', 'user_id');
    }
}
