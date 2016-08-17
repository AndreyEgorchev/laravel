<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function getNameCity($id)
    {
        
        $city=$this->where('id','=', $id)->first();
        return $city;
    }
}
