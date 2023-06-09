<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    public function centers()
    {
        return $this->belongsTo(\App\Centers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
