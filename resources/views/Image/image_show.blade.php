@extends('layouts.app')


@section('content')

    {{--{!! Breadcrumb::withLinks(['Home'   => '/',--}}
    {{--'marketing images' => '/image',--}}
    {{--"show $marketingImage->image_name.$marketingImage->image_extension"--}}
    {{--]) !!}--}}

    <div>

        {{ $marketingImage->image_name }} :  <br>

        <img src="public/images/uploads/{{ $marketingImage->image_name . '.' .
         $marketingImage->image_extension . '?'. 'time='. time() }}">

    </div>

    <div>

        {{ $marketingImage->image_name }} - thumbnail :  <br>

        <img src="public/images/uploads/thumbnails/{{ 'thumb-' . $marketingImage->image_name . '.' .
    $marketingImage->image_extension . '?'. 'time='. time() }}">

    </div>

    <div>

        {{ $marketingImage->mobile_image_name }} - mobile :  <br>

        <img src="public/images/uploads/mobile/{{ $marketingImage->mobile_image_name . '.' .
         $marketingImage->mobile_extension . '?'. 'time='. time() }}">

    </div>

@endsection