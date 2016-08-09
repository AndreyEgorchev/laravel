<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'specialty_name'
    ];
    public function getNameSpeciality($id)
    {
        $speciality=$this->latest('specialty_name')->where('id','=', $id)->first();
        return $speciality;

    }
}
