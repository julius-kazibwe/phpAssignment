<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    protected $fillable=['id','doctor_id','patient_id','vaccine','created_at'];

    public function prescribedproducts()
    {
        return $this->hasMany(PrescribedProduct::class);
    }
    public function doctor()
    {
        return $this->belongsTo(\App\Center::class);
    }
}