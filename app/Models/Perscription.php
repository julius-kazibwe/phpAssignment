<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perscription extends Model
{
    protected $guarded = [];


    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
