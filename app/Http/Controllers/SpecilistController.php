<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Region;
use App\Specialist;
use App\Speciality;
use Illuminate\Http\Request;
use App\Images;
use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;
use Sentinel;

class SpecilistController extends Controller
{
    protected $rules = [
        'first_name' => 'required|max:15',
        'last_name' => 'required|max:15',
        'phone_number' => 'required|regex:/^\+\d{2}\d{3}\d{3}\d{2}\d{2}$/',
        'email' => 'required|regex:/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',
        'description' => 'required|min:50',
        'link_vk' => 'required|url',
        'link_instagram' => 'required|url',
        'link_fb' => 'required|url',
        'attachments' => 'required',
        'specialty_name_1' => 'required',
        'specialty_name_2' => 'required|different:specialty_name_1|different:specialty_name_3',
        'specialty_name_3' => 'required|different:specialty_name_1|different:specialty_name_2',
        "city_first" => 'required|different:city_second|different:city_third',
        "city_second" => 'required|different:city_first|different:city_third',
        "city_third" => 'required|different:city_first|different:city_second',
        "region_1" => 'required|not_in:0',
        "region_2" => 'required|not_in:0',
        "region_3" => 'required|not_in:0'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Specialist $specialistmodel, Speciality $specialitymodel)
    {
        $specialists = Specialist::all();
        $speciality = Speciality::all();
        foreach ($specialists as $key) {
            $key['cityfull'] = $specialistmodel->getCityForSpec($key->id);
            $key['specialityfull'] = $specialistmodel->getSpecialityForSpec($key->id);
        }
        $region = Region::all();
        return view('specialist.specialists', [
            'specialists' => $specialists,
            'speciality' => $speciality,
            'region' => $region
        ]);
    }


    /**
     * @param RegionContract $region
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $speciality=DB::table('specialities')->lists('specialty_name','id');
        $region = Region::all();
        return view('specialist.specialists_create', [
            'region' => $region,
            'speciality' => $speciality]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $this->validate($request, $this->rules);
            $array=$request->all();
            $array['id_user']=Sentinel::getUser()->id;
            $spec = Specialist::create($array);

//            $spec->city()->attach([$request->city_first, $request->city_second, $request->city_third]);
//            $spec->specialitys()->attach([$request->specialty_name_1, $request->specialty_name_2, $request->specialty_name_3]);

            $files = $request->file('attachments');

            if (!empty($files)) {
                foreach ($files as $file) {

//                    $img=Image::make( $file);
//                    $image = new Images($files);
//                    $path = public_path().'/images/uploads/avatars/';
//                    $img->save($path.$image->getClientOriginalName())->resizeCanvas(500,500,'top')->resize(256,256)->save($path.'thumb_'.$image->getClientOriginalName());
//                    $input['avatar'] = '/images/uploads/avatars/'.'thumb_'.$image->getClientOriginalName();




                    $image = new Images($files);
                    $filename =  time().'.'.$file->getClientOriginalName();
                    $image['originalName'] = $filename;
                    $image['mimeType'] = $file->getClientMimeType();
                    $image['size'] = $file->getClientSize();
                    // Set the destination path
                    $destinationPath = 'images/uploads';
                    // Get the orginal filname or create the filename of your choice
                    // Copy the file in our upload folder
                    $file->move($destinationPath, $filename);

                    $image['pathName'] = $destinationPath;
                    $spec->images()->save($image);
                }
            }
            return Redirect::to('profile/' . Sentinel::getUser()->id);


    }


    /**
     * @param City $citymodel
     * @param Speciality $specmodel
     * @param $id
     * @param Images $imagemodel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Specialist $specialistmodel)
    {
        $specialists = Specialist::find($id);
        $specialists['cityfull'] = $specialistmodel->getCityForSpec($id);
        $specialists['specialityfull'] = $specialistmodel->getSpecialityForSpec($id);
        $images = $specialists->images;
        return view('specialist.specialists_show', ['specialists' => $specialists,
            'images' => $images]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialist $specialistmodel, $id, Region $regionymodel, City $citymodel)
    {
        $specialists = Specialist::find($id);
        $specialists['speciality'] = $specialistmodel->getSpecialityForSpec($id);
        $specialists['allspeciality'] = Speciality::all();
        $specialists['images'] = $specialists->images;
        $temp = $specialists->getCityForSpec($id);
        foreach ($temp as $key) {
            $region[] = $regionymodel->getNameRegion($key->region);
            $city[] = $citymodel->getCity($key->region);
        }
        $specialists['region'] = $region;
        $specialists['allregion'] = Region::all();
        $specialists['city'] = $temp;
        $specialists['cityuser'] = $city;
        return view('specialist.specialists_edit')->withTask($specialists);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $specialist = Specialist::findOrFail($id);
        $this->validate($request, $this->rules);
        $input = $request->all();
        $files = $request->file('attachments');
//        dd($files);
        if (!$files==null) {
            foreach ($files as $file) {
//                dd($file);



                $image = new Images($files);
                $filename = rand(11111,99999).$file->getClientOriginalName();
                $image['originalName'] = $filename;
                $image['mimeType'] = $file->getClientMimeType();
                $image['size'] = $file->getClientSize();
                // Set the destination path
                $destinationPath = 'images/uploads';
                // Get the orginal filname or create the filename of your choice

//                dd($filename);
                // Copy the file in our upload folder
                $file->move($destinationPath, $filename);

                $image['pathName'] = $destinationPath;
                $specialist->images()->save($image);
            }
        }
        $specialist->city()->sync(array($request->city_first, $request->city_second, $request->city_third));
        $specialist->specialitys()->sync(array($request->specialty_name_1, $request->specialty_name_2, $request->specialty_name_3));
        $specialist->fill($input)->save();
        return Redirect::to('profile/' . Sentinel::getUser()->id);
//        }
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
        foreach ($specialist_image as $item) {
            $destinationPath = '\images\uploads/';
            unlink(public_path() . $destinationPath . $item->originalName);
            $item->delete();
        }
        $specialist->delete();
        return Redirect::to('profile/' . Sentinel::getUser()->id);
    }

    public function getCity_first(City $citymodel)
    {

        if (isset($_POST['id_first']) && !empty($_POST['id_first'])) {
            $city = $citymodel->getCity(intval($_POST['id_first']));
            echo "<select name='city_first' class='area_first'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key) {
                echo " <option value=" . $key['id'] . ">" . $key['city_ua'] . "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }

    public function getCity_filter(City $citymodel)
    {

        if (isset($_POST['city_filter']) && !empty($_POST['city_filter'])) {
            $city = $citymodel->getCity(intval($_POST['city_filter']));
            echo "<select name='city_first' class='filter2'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key) {
                echo " <option value=" . $key['id'] . ">" . $key['city_ua'] . "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }


    public function getCity_second(City $citymodel)
    {

        if (isset($_POST['id_second']) && !empty($_POST['id_second'])) {
            $city = $citymodel->getCity(intval($_POST['id_second']));
            echo "<select name='city_second' class='area_second'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key) {
                echo " <option value=" . $key['id'] . ">" . $key['city_ua'] . "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }

    public function getCity_third(City $citymodel)
    {

        if (isset($_POST['id_third']) && !empty($_POST['id_third'])) {
            $city = $citymodel->getCity(intval($_POST['id_third']));
            echo "<select name='city_third' class='area_third'>";
            echo " <option>--Виберіть Місто--</option>";
            foreach ($city as $key) {
                echo " <option value=" . $key['id'] . ">" . $key['city_ua'] . "</option>";
            }
            echo "</select>";
        }
        return new Response();
    }


    public function getFilter(Request $request, Specialist $specmodel)
    {
        if (empty($_POST['filter1_id']) && intval($_POST['filter3_id']) == 0 && intval($_POST['filter2_id']) == 0) {

            $specialists = Specialist::all();
        } else {
            $specialists = $specmodel->filter($_POST['filter1_id'], intval($_POST['filter3_id']), intval($_POST['filter2_id']));
            if ($specialists === null) {
                return new Response();
            }

        }
//        dd($specialists);
        foreach ($specialists as $key) {
            $key['cityfull'] = $specmodel->getCityForSpec($key->id);
            $key['specialityfull'] = $specmodel->getSpecialityForSpec($key->id);
        }
        foreach ($specialists as $specialist) {
            echo "<dt class='list-determination_definition'>" . $specialist->first_name . "</dt>";
            echo "<dt class='list-determination_definition'>" . $specialist->last_name . "</dt>";
            echo "<dt class='list-determination_definition'>" . $specialist->phone_number . "</dt>";
            echo "<dt class='list-determination_definition'>" . $specialist->email . "</dt>";
            echo "<dt class='list-determination_definition'>";
            foreach ($specialist->cityfull as $city) {
                echo $city->city_ua;
                echo " ";
            }
            echo " </dt>";
            echo " <dt class='list-determination_definition'>";
            foreach ($specialist->specialityfull as $speciality) {
                echo $speciality->specialty_name;
                echo " ";
            }
            echo " </dt>";
            echo " <p>";
            echo "<a href=" . route('specialists.show', $specialist->id) . " class='btn btn-info'>Переглянути профіль</a>";
            echo "</p>";


        }

        return new Response();
    }
    public function del_image(Request $request){
        if (isset($_POST['src']) && !empty($_POST['src'])) {
            $src=$request->input("src");
            $root=$_SERVER['DOCUMENT_ROOT'];
            $array = explode('..', $src);
            $array_image = explode('/', $array[1]);
            $specialist = Specialist::where('id_user',Sentinel::getUser()->id)->first();
            $image = Images::where('specialist_id',$specialist->id)->where('originalName',$array_image[3])->first();
            $image->delete();
            unlink($root.$array[1]);
        }
    }
}
