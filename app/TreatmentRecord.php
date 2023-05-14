<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentRecord extends Model
{
    public $timestamps = false;

    protected $fillable = ['center_id','patient_id','fullname','nin','date','vaccine'];
    protected $primarykey = 'record_id';
}
