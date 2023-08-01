<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthday',
        'age',
        'address',
        'gender',
        'mobileno',
        'email',
        'username',
        'password',
        'usertype',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appointment(){
        //1st parameter - unique id sa appointment table
       //2nd parameter - unique id sa user table (sa table na pagmumulan ng data)
        return $this->hasOne(Appointment::class, 'user_id', 'id'); // select * from appointment where id or userid = 
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function consultation(){
        return $this->hasMany(Consultation::class, 'user_id', 'id');
    }
 
}
