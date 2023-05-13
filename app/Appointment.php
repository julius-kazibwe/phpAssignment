<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
