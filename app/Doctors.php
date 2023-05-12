<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $primaryKey = 'doctor_id';

    protected $fillable=['doctor_id','fullname','nic','type'];

    public function prescribedproducts()
    {
        return $this->hasMany(Doctors::class);
    }
}