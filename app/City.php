<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function getNameCity($id)
    {
        
        $city=$this->latest('city_ua')->where('id','=', $id)->first();
        return $city;
    }
}
