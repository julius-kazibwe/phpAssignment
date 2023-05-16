<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    protected $fillable=['id','center_id','patient_id','vaccine','created_at'];

   
    public function center()
    {
        return $this->belongsTo(\App\Center::class);
    }
}