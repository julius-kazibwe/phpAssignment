<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function center()
    {
        return $this->belongsTo(\App\Center::class);
    }
    public function vaccines()
    {
        return $this->hasMany(\App\vaccine::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
{
    return $this->hasMany(CenterSchedule::class);
}

}
