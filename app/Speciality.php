<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'specialty_name'
    ];
    public function getSpeciality()
    {
//        $speciality=Speciality::all();
//        return $speciality;
    }
}
