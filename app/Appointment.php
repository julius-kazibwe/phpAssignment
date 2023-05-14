<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Center;
class Appointment extends Model
{
    protected $guarded = [];

    public function center()
    {
        return $this->belongsTo(Center::class, 'doctor_id', 'id');
    }
}
