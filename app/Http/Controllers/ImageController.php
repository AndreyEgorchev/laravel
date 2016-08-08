<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
//use Image;
use Storage;
use Response;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Image;
use File;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\EditImageRequest;
class ImageController extends Controller
{
    protected $cacheTime=12960;

//    public function __construct()
//    {
//        $this->middleware('web');
//    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();

        return view('image.image_index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('image.image_create');
    }
    public function formatCheckboxValue($marketingImage)
    {

        $marketingImage->is_active = ($marketingImage->is_active == null) ? 0 : 1;
        $marketingImage->is_featured = ($marketingImage->is_featured == null) ? 0 : 1;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateImageRequest $request)
    {
        $marketingImage = new Image([
            'image_name'        => $request->get('image_name'),
            'image_extension'   => $request->file('image')->getClientOriginalExtension(),
            'mobile_image_name' => $request->get('mobile_image_name'),
            'mobile_extension'  => $request->file('mobile_image')->getClientOriginalExtension(),
            'is_active'         => $request->get('is_active'),
            'is_featured'       => $request->get('is_featured'),

        ]);

        //define the image paths

        $destinationFolder ='../public/uploads';
        $destinationThumbnail = '../public/uploadsthumbnails';
        $destinationMobile = '../public/uploads/mobile';

        //assign the image paths to new model, so we can save them to DB

        $marketingImage->image_path = $destinationFolder;
        $marketingImage->mobile_image_path = $destinationMobile;

        // format checkbox values and save model

        $this->formatCheckboxValue($marketingImage);
        $marketingImage->save();

        //parts of the image we will need

        $file = Input::file('image');

        $imageName = $marketingImage->image_name;
        $extension = $request->file('image')->getClientOriginalExtension();

        //create instance of image from temp upload

        $image = Image::make($file->getRealPath());

        //save image with thumbnail

        $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
            ->resize(60, 60)
            // ->greyscale()
            ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);

        // now for mobile

        $mobileFile = Input::file('mobile_image');

        $mobileImageName = $marketingImage->mobile_image_name;
        $mobileExtension = $request->file('mobile_image')->getClientOriginalExtension();

        //create instance of image from temp upload
        $mobileImage = Image::make($mobileFile->getRealPath());
        $mobileImage->save(public_path() . $destinationMobile . $mobileImageName . '.' . $mobileExtension);


        // Process the uploaded image, add $model->attribute and folder name

//        flash()->success('Marketing Image Created!');

        return redirect()->route('image.show', [$marketingImage]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marketingImage = Image::findOrFail($id);

        return view('image.image_show', compact('marketingImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marketingImage = Image::findOrFail($id);

        return view('image.edit', compact('marketingImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditImageRequest  $request, $id)
    {
        $marketingImage = Image::findOrFail($id);

        $marketingImage->is_active = $request->get('is_active');
        $marketingImage->is_featured = $request->get('is_featured');

        $this->formatCheckboxValue($marketingImage);
        $marketingImage->save();

        if ( ! empty(Input::file('image'))){

            $destinationFolder = 'public/images/uploads/';
            $destinationThumbnail = 'public/images/uploads/thumbnails/';

            $file = Input::file('image');

            $imageName = $marketingImage->image_name;
            $extension = $request->file('image')->getClientOriginalExtension();

            //create instance of image from temp upload
            $image = Image::make($file->getRealPath());

            //save image with thumbnail
            $image->save(public_path() . $destinationFolder . $imageName . '.' . $extension)
                ->resize(60, 60)
                // ->greyscale()
                ->save(public_path() . $destinationThumbnail . 'thumb-' . $imageName . '.' . $extension);

        }

        if ( ! empty(Input::file('mobile_image'))) {

            $destinationMobile = 'public/images/uploads/mobile/';
            $mobileFile = Input::file('mobile_image');

            $mobileImageName = $marketingImage->mobile_image_name;
            $mobileExtension = $request->file('mobile_image')->getClientOriginalExtension();

            //create instance of image from temp upload
            $mobileImage = Image::make($mobileFile->getRealPath());
            $mobileImage->save(public_path() . $destinationMobile . $mobileImageName . '.' . $mobileExtension);
        }

        flash()->success('image edited!');
        return view('image.edit', compact('marketingImage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marketingImage = Image::findOrFail($id);
        $thumbPath = $marketingImage->image_path.'thumbnails/';

        File::delete(public_path($marketingImage->image_path).
            $marketingImage->image_name . '.' .
            $marketingImage->image_extension);

        File::delete(public_path($marketingImage->mobile_image_path).
            $marketingImage->mobile_image_name . '.' .
            $marketingImage->mobile_extension);
        File::delete(public_path($thumbPath). 'thumb-' .
            $marketingImage->image_name . '.' .
            $marketingImage->image_extension);

        Image::destroy($id);

//        flash()->success('image deleted!');

        return redirect()->route('image.index');
    }


//
//    public function fullImage($dateImg=null, $filename=null)
//    {
//        $filePath = 'attaches/' . $dateImg .'/'. $filename;
//        return Storage::get($filePath);
//    }
//
//    /**
//     * @param $dateImg
//     * @param $filename
//     * @param $w
//     * @param $h
//     * @param null $type
//     * @param null $anchor possible: top-left, top, top-right, left, center (default), right, bottom-left, bottom, bottom-right
//     * @return mixed
//     */
//    public function whResize($dateImg, $filename, $w , $h , $type=null, $anchor=null)
//    {
//        $filePath = storage_path('app/attaches/' . $dateImg .'/'. $filename);
//        if (! $anchor) $anchor='center';
//        if (! $type) $type='outbox';
//        if ($w=='w') $w=null;
//        if ($h=='h') $h=null;
//
//        $params = (object) array(
//            'filePath' =>$filePath,
//            'w' => $w,
//            'h' => $h,
//            'cw' => $w,
//            'ch' => $h,
//            'anchor' => $anchor,
//        );
//
//        switch ($type) {
//            case 'asis':
//                $cacheImage = Image::cache(function($image) use( $filePath, $w, $h, $type){
//                    return $image->make($filePath)->resize($w, $h);
//                });
//                break;
//            case 'prop':
//                if($w>$h) $params->w = null;
//                else $params->h = null;
//                $cacheImage = $this->resizeAndChunk($params);
//                break;
//            case 'chunk':
//                if($w>$h) $params->h = null;
//                else $params->w = null;
//                $cacheImage = $this->resizeAndChunk($params);
//                break;
//            case 'outbox':
//                $cacheImage = Image::cache(function($image) use( $params){
//                    return $image->make($params->filePath)->resize($params->w, $params->h, function ($constraint) {
//                        $constraint->aspectRatio();
//                        $constraint->upsize();
//                    });
//                },$this->cacheTime,false);
//                break;
//        }
//        return Response::make($cacheImage, 200, array('Content-Type' => 'image/jpeg'));
//    }
//
//    protected function resizeAndChunk($params)
//    {
//        return Image::cache(function($image) use( $params){
//            return $image->make($params->filePath)->resize($params->w, $params->h, function ($constraint) {
//                $constraint->aspectRatio();
//                $constraint->upsize();
//            })->resizeCanvas($params->cw, $params->ch, $params->anchor);
//        },$this->cacheTime,false);
//    }
}
