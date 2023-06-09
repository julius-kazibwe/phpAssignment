<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $primaryKey = 'patient_id';
    protected $fillable = [
        'fullname','gender','dob','nin','address1','address2','city','phone', 'email','username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;



    // A patient has many appointments
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }

    // A patient has many feedbacks
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }

    

    public function prescriptions(){
        return $this->hasMany('App\Prescription');
    }


}
