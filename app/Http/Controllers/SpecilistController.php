<?php

namespace App\Http\Controllers;

use App\City;
use App\Helpers\RegionContract;
use App\Region;
use App\Specialist;
use App\Speciality;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Response;

class SpecilistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Specialist $specialistmodel)
    {
        $specialists=Specialist::all();
        //dd($specialists);
        return view('specialist.specialists',['specialists'=>$specialists]);
    }


    /**
     * @param RegionContract $region
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $speciality=Speciality::all();
        $region=Region::all();
        return view('specialist.specialists_create',['region'=>$region,
        'speciality'=>$speciality]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        Specialist::create($request->all());
        return redirect()->back();
    }


    /**
     * @param City $citymodel
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $citymodel,Speciality $specmodel, $id)
    {
        $specialists=Specialist::find($id);
        $city_first=$citymodel->getNameCity($specialists->city_first);
        $city_second=$citymodel->getNameCity($specialists->city_second);
        $city_third=$citymodel->getNameCity($specialists->city_third);
        $speciality=$specmodel->getNameSpeciality($specialists->specialty_name);
        return view('specialist.specialists_show',['specialists'=>$specialists,
                                                   'city_first'=>$city_first->city_ua,
                                                    'city_second'=>$city_second->city_ua,
                                                    'city_third'=>$city_third->city_ua,
                                                    'speciality'=>$speciality->specialty_name]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialists=Specialist::find($id);
        return view('specialist.specialists_edit')->withTask($specialists);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $specialist = Specialist::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $input = $request->all();

        $specialist->fill($input)->save();



        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->delete();
        return redirect()->route('specialists.index');
    }

    public function getCity_first(Request $request)
    {

        if (isset($_POST['id_first']) && !empty($_POST['id_first'])) {
            $id_first = intval($_POST['id_first']);

            $city=City::latest('city_ua')
                ->where('region','=',$id_first)
                ->get();

            echo "<select name='city_first' class='area_first'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key)
            {
                echo " <option value=".$key['id'].">" .$key['city_ua']. "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }
    public function getCity_second(Request $request)
    {

        if (isset($_POST['id_second']) && !empty($_POST['id_second'])) {
            $id_second = intval($_POST['id_second']);

            $city=City::latest('city_ua')
                ->where('region','=',$id_second)
                ->get();

            echo "<select name='city_second' class='area_second'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key)
            {
                echo " <option value=".$key['id'].">" .$key['city_ua']. "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }
    public function getCity_third(Request $request)
    {

        if (isset($_POST['id_third']) && !empty($_POST['id_third'])) {
            $id_third = intval($_POST['id_third']);

            $city=City::latest('city_ua')
                ->where('region','=',$id_third)
                ->get();

            echo "<select name='city_third' class='area_third'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key)
            {
                echo " <option value=".$key['id'].">" .$key['city_ua']. "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }

}
