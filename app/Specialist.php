<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Images', 'specialist_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meta()
    {
        return $this->belongsToMany('App\Meta_tags', 'spec_meta_tags', 'specialist_id', 'meta_tags_id');
    }

    public function setMetatagsAttribute($tags)
    {
        $this->meta()->detach();
        if (!$tags) {
            return;
        }
        if (!$this->exists) {
            $this->save();
        }
        $this->meta()->attach($tags);
    }

    public function getMetatagsAttribute($tags)
    {
        return array_pluck($this->meta()->get(['id'])->toArray(), 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getFullCityAttribute()
    {
        $citymodel = new City();
        $array_city = array($this->city_first, $this->city_second, $this->city_third);
        foreach ($array_city as $key) {
            $city[] = $citymodel->getNameCity($key);
        }

        foreach ($city as $key) {
            $city_name[] = $key->city_ua;
        }

        return $city_name[0] . ', ' . $city_name[1] . ', ' . $city_name[2];
    }

    public function getAllcity($filter2_id)
    {
        if (isset($filter2_id) && !empty($filter2_id)) {
            $specialist = Specialist::all();
            foreach ($specialist as $item) {
                $city_1[] = 0;
                if ($item->city_first == $filter2_id) {
                    $city_1[] = $item->id;
                }
                $city_2[] = 0;
                if ($item->city_second == $filter2_id) {
                    $city_2[] = $item->id;
                }
                $city_3[] = 0;
                if ($item->city_third == $filter2_id) {
                    $city_3[] = $item->id;
                }
            }
            $city = array_merge($city_1, $city_2, $city_3);
            $array = array_diff($city, ["0"]);
            if (count($array) < 1) {
                $array[] = 0;
                return $array;
            } else {
                return $array;
            }
        }


    }

    public function filter($filter1_id,$filter3_id,$city)
    {
        $specialists = Specialist::latest('last_name')
            ->when($filter1_id, function ($query) use ($filter1_id) {
                return $query->where('id', $filter1_id);
            })
            ->when($filter3_id, function ($query) use ($filter3_id) {
                return $query->where('specialty_name', $filter3_id);
            })
            ->when($city, function ($query) use ($city) {
                return $query->whereIn('id', $city);
            })
            ->get();
        return $specialists;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            Session::set('array_image', $model->image);  //add image in session
            unset($model->image);                        //delete image on array model
        });
        static::created(function ($model) {
            $array_image = Session::get('array_image'); //get image with session
            if ($array_image) {
                foreach ($array_image as $item) {            //add image with id in field specialist_id
                    $img = new Images($array_image);
                    list($parent_folder, $child_folder, $nameImage,) = explode("/", $item);
                    $img['originalName'] = $nameImage;
                    $img['specialist_id'] = $model->id;
                    $img['pathName'] = $parent_folder . '/' . $child_folder . '/';
                    $img->save();
                }
            }
        });
        static::updating(function ($model) {
            if (empty($array_image)) {
                foreach ($model->image as $item) {
                    $img = new Images($model->image);
                    list($parent_folder, $child_folder, $nameImage,) = explode("/", $item);
                    $img['originalName'] = $nameImage;
                    $img['specialist_id'] = $model->id;
                    $img['pathName'] = $parent_folder . '/' . $child_folder . '/';
                    $img->save();
                }
                unset($model->image);
            }
        });
    }
}
