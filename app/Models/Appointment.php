<?php

namespace App\Models;

use App\Services\AuditTrailService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $casts = [
        'date' => 'date',
    ];

    public function setDateAttribute( $value ) {
            $this->attributes['date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
      }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
    
    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

// public function user(){
//     //parameter
//                                         //2nd unique id sa appointment table 
//                                             //3rd  unique id sa user table
//     // return $this->belongsTo(User::class, 'user_id', 'id'); // select * from user where 
//     return $this->hasMany(User::class, 'id', 'user_id');
// }

//has many (kunin yung count ng female)
public function users_female(){
    //parameter
                                        //2nd unique id sa user table 
                                            //3rd  unique id sa appointmetn table
    return $this->hasMany(User::class, 'id', 'user_id')->where('gender', 'Female'); // select * from user where 
}

//has many (kunin yung count ng female)
public function users_male(){
    //parameter
                                        //2nd unique id sa user table 
                                            //3rd  unique id sa appointmetn table
    return $this->hasMany(User::class, 'id', 'user_id')->where('gender', 'Male'); // select * from user where 
}

public function user(){
    //parameter
                                        //2nd unique id sa appointment table 
                                            //3rd  unique id sa user table
    return $this->belongsTo(User::class, 'user_id', 'id'); // select * from user where 
    // return $this->hasMany(User::class, 'id', 'user_id');
}


}
