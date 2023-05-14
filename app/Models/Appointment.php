<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Center;
use App\Time;

class Appointment extends Model
{
    protected $guarded = [];
    

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }
    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
