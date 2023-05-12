<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function doctor()
    {
        return $this->belongsTo(\App\Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
{
    return $this->hasMany(DoctorSchedule::class);
}

}
