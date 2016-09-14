@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel-body">
            <h1>
                Create
            </h1>
            {!! Form::open(array(
            'route'=>'specialists.store',
            'files'=>true
            )) !!}
            <div class="form-group">
                {!! Form::label('first_name') !!}
                {!! Form::text('first_name', Request::old('first_name'),['class'=>'form-control']) !!}
                @if( $errors->has('first_name'))
                    @foreach( $errors->get('first_name') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('last_name') !!}
                {!! Form::text('last_name', Request::old('last_name'),['class'=>'form-control']) !!}
                @if( $errors->has('last_name'))
                    @foreach( $errors->get('last_name') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('specialty_name') !!}
                <select size="1" name="specialty_name" class="special_select" required>
                    <option value="0" selected>--Виберіть спеціальність--</option>
                    @foreach($speciality as $key )
                        <option value="{{ $key->id }}"
                        @if (old('specialty_name') == $key->id)
                            {{'selected'}}
                                @endif >
                            {{ $key->specialty_name }}
                        </option>
                    @endforeach
                </select>


            </div>
            <div class="form-group">
                {!! Form::label('phone_number') !!}
                {!! Form::text('phone_number', Request::old('phone_number'),['class'=>'form-control']) !!}
                @if( $errors->has('phone_number'))
                    @foreach( $errors->get('phone_number') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('email') !!}
                {!! Form::text('email', Request::old('email'),['class'=>'form-control']) !!}
                @if( $errors->has('email'))
                    @foreach( $errors->get('email') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('link_vk') !!}
                {!! Form::text('link_vk', Request::old('link_vk'),['class'=>'form-control']) !!}
                @if( $errors->has('link_vk'))
                    @foreach( $errors->get('link_vk') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('link_fb') !!}
                {!! Form::text('link_fb', Request::old('link_fb'),['class'=>'form-control']) !!}
                @if( $errors->has('link_fb'))
                    @foreach( $errors->get('link_fb') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('link_instagram') !!}
                {!! Form::text('link_instagram', Request::old('link_instagram'),['class'=>'form-control']) !!}
                @if( $errors->has('link_instagram'))
                    @foreach( $errors->get('link_instagram') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>

            <div class="form-group">

                <div class="col-md-4">
                    <div id="hideImg" class="city_first">

                        <p>
                            <select size="1" name="region" class="regionId_first" required>
                                <option value="0" selected>--Виберіть Область--</option>
                                @foreach($region as $key )
                                    <option value="{{ $key->id }}">{{ $key->region_ua }}</option>
                                @endforeach
                            </select>
                        <div class="first">
                    <span class="area_first">

                    </span>
                        </div>

                        <div>
                            <input id="showImg2" type="button" value="Add city"/>
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
                            <input id="showImg3" type="button" value="Add city"/>
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
                @if( $errors->has('description'))
                    @foreach( $errors->get('description') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>
            <div class="form-group">
                {{--<!-- The file upload form used as target for the file upload widget -->--}}
                {{--<input type="file" name="attachments[]" multiple/>--}}
                @if( $errors->has('file'))
                    @foreach( $errors->get('file') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif
            </div>

            <div class="controls">
                {!! Form::file('attachments[]', array('multiple'=>true)) !!}
                @if( $errors->has('attachments'))
                    @foreach( $errors->get('attachments') as $error)
                        <p class='alert alert-danger'>
                            {{$error}}
                        </p>
                    @endforeach
                @endif

            </div>
            <div class="form-group">
                {!! Form::submit('Create New Task', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection