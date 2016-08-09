@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel-body">
            <h1>
                Create
            </h1>
            {!! Form::open(['route'=>'specialists.store']) !!}
            <div class="form-group">
                {!! Form::label('first_name') !!}
                {!! Form::text('first_name', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name') !!}
                {!! Form::text('last_name', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('specialty_name') !!}
                {{--{!! Form::text('specialty_name', null,['class'=>'form-control']) !!}--}}
                <select size="1" name="specialty_name" class="special_select" required>
                    <option value="0" selected>--Виберіть спеціальність--</option>
                    @foreach($speciality as $key )
                        <option value={{ $key->id }} >{{ $key->specialty_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('phone_number') !!}
                {!! Form::text('phone_number', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email') !!}
                {!! Form::text('email', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('link_vk') !!}
                {!! Form::text('link_vk', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('link_fb') !!}
                {!! Form::text('link_fb', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('link_instagram') !!}
                {!! Form::text('link_instagram', null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">

                <div class="col-md-4">
                    <div id="hideImg" class="city_first">

                        <p>
                            <select size="1" name="region" class="regionId_first" required>
                                <option value="0" selected>--Виберіть Область--</option>
                                @foreach($region as $key )
                                    <option value={{ $key->id }} >{{ $key->region_ua }}</option>
                                @endforeach
                            </select>
                        <div class="first">
        <span class="area_first">

        </span>
                        </div>

                        <div>
                            <input id="showImg2" type="button" value="Add city" />
                        </div>
                    </div>

                </div>
                {{-------------------------------------------------------------------------------------------------------------------------}}
                <div class="col-md-4">

                    <div id="hideImg22" class="city_second">

                        <p>
                            <select size="1" name="region" class="regionId_second" required>
                                <option value="0">--Виберіть Область--</option>
                                @foreach($region as $key )
                                    <option value={{ $key->id }} >{{ $key->region_ua }}</option>
                                @endforeach

                            </select>
                        <div class="second">
    <span class="area_second">

    </span>
                        </div>
                        <div>
                            <input id="showImg3" type="button" value="Add city" />
                        </div>
                    </div>

                </div>

                {{-----------------------------------------------------------------------------------------------------------------------------}}
                <div class="col-md-4">
                    <div id="hideImg33" class="city_third">
                        <p>
                            <select size="1" name="region" class="regionId_third" required>
                                <option value="0">--Виберіть Область--</option>
                                @foreach($region as $key )
                                    <option value={{ $key->id }} >{{ $key->region_ua }}</option>
                                @endforeach

                            </select>

                        <div class="third">
    <span class="area_third">

    </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description') !!}
                {!! Form::textarea('description', null,['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Create New Task', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection