<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentRecord extends Model
{
    public $timestamps = false;

    protected $fillable = ['center_id','patient_id','date','vaccine_id'];
    protected $primarykey = 'record_id';
}
