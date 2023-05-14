<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    public $timestamps =false;  
    
    // a doctor visits patient many days
    protected $fillable=['center_id','center_name','location','vaccine_id'];
    protected $primaryKey = 'center_id';


    public function visitingdays()
    {
        return $this->hasMany('App\Models\CenterSchedule');
    }

   

    // a doctor has many appointments(with patients)
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }
    public function vaccines()
    {
        return $this->hasMany('App\Models\Vaccine');
    }

    // a doctor has many notices
    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

   
    public function bookings()
    {
        return $this->hasMany('App\nodels\Booking');
    }


}
