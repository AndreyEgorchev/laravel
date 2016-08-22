<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Region;
use App\Specialist;
use App\Speciality;
use Illuminate\Http\Request;
use App\Images;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Response;
use Input;


class SpecilistController extends Controller
{
    protected         $rules=[
        'first_name'=> 'required|max:15',
        'last_name'=> 'required|max:15',
        'phone_number'=> 'required|regex:/^\+\d{2}\d{3}\d{3}\d{2}\d{2}$/',
        'email'=> 'required|regex:/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',
        'description'=> 'required|min:50',
        'link_vk'=> 'required|url',
        'link_instagram'=> 'required|url',
        'link_fb'=> 'required|url',
        'attachments' => 'required',
        'specialty_name'=>'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Specialist $specialistmodel)
    {
        $specialists=Specialist::all();
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
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
        {
            $spec= Specialist::create($request->all());
            $files = $request->file('attachments');
            if (!empty($files)) {
                foreach($files as $file) {
                    $image= new Images($files);
                    $image['originalName']=$file->getClientOriginalName();
                    $image['mimeType']=$file->getClientMimeType();
                    $image['size']=$file->getClientSize();
                    // Set the destination path
                    $destinationPath = 'images/uploads';
                    // Get the orginal filname or create the filename of your choice
                    $filename = $file->getClientOriginalName();
                    // Copy the file in our upload folder
                    $file->move($destinationPath, $filename);

                    $image['pathName']=$destinationPath;
                    $spec->images()->save($image);
                }
            }
        }

        return redirect()->back();
    }


    /**
     * @param City $citymodel
     * @param Speciality $specmodel
     * @param $id
     * @param Images $imagemodel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $citymodel, Speciality $specmodel, $id, Images $imagemodel)
    {
        $specialists=Specialist::find($id);
        $array_city=array($specialists->city_first,$specialists->city_second,$specialists->city_third);
        foreach ($array_city as $key){
            $city[]=$citymodel->getNameCity($key);
        }
        $speciality=$specmodel->getNameSpeciality($specialists->specialty_name);
        $images=$specialists->images;
        return view('specialist.specialists_show',['specialists'=>$specialists,
                                                   'city'=>$city,
                                                   'speciality'=>$speciality->specialty_name,
                                                    'images'=>$images]);

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
     * @param $id
     * @param Images $imagemodel
     * @return mixed
     */
    public function destroy($id, Images $imagemodel)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist_image = $specialist->images;
        foreach ($specialist_image as $item){
            $destinationPath = '\images\uploads/';
            unlink(public_path().$destinationPath.$item->originalName);
          $item->delete();
        }
        $specialist->delete();
        return Redirect::to('specialists');
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
