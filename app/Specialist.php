<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;

/**
 * Class Specialist
 * @package App
 */
class Specialist extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'description',
        'link_vk',
        'link_instagram',
        'link_fb',
        'city_first',
        'city_second',
        'city_third',
        'specialty_name',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function images()
    {
        return $this->hasMany('app\Images');
    }
    
}
