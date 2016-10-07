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
                <div class="col-md-12">
                    <div class="col-md-6">
                        @include('widgets.form._formitem_text', ['name' => 'first_name', 'title' => 'first_name', 'placeholder' => 'Імя','class'=> "form-control" ])
                    </div>
                    <div class="col-md-6">
                        @include('widgets.form._formitem_text', ['name' => 'last_name', 'title' => 'last_name', 'placeholder' => 'Прізвище','class'=> "form-control" ])
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4 form-control-static">
                        @include('widgets.form._formitem_select_speciality', ['name' => 'specialty_name_1', 'title' => 'specialty_name_1', 'placeholder' => '--Виберіть спеціальність--' ])
                    </div>
                    {{----------------------------------------------------------------------------------------------------------------------------------}}

                    <div class="col-md-4 form-control-static">
                        @include('widgets.form._formitem_select_speciality', ['name' => 'specialty_name_2', 'title' => 'specialty_name_2', 'placeholder' => '--Виберіть спеціальність--','class'=> "form-control" ])
                    </div>
                    {{-----------------------------------------------------------------------------------------------------------------------------------}}
                    <div class="col-md-4 form-control-static">
                        @include('widgets.form._formitem_select_speciality', ['name' => 'specialty_name_3', 'title' => 'specialty_name_3', 'placeholder' => '--Виберіть спеціальність--','class'=> "form-control" ])
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-6">
                        @include('widgets.form._formitem_text', ['name' => 'phone_number', 'title' => 'phone_number', 'placeholder' => 'Номер телефону','class'=> "form-control" ])
                    </div>
                    <div class="col-md-6">
                        @include('widgets.form._formitem_text', ['name' => 'email', 'title' => 'Email', 'placeholder' => 'email','class'=> "form-control" ])

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4">
                        @include('widgets.form._formitem_text', ['name' => 'link_vk', 'title' => 'Email', 'placeholder' => 'Вконтакте','class'=> "form-control" ])
                    </div>

                    <div class="col-md-4">
                        @include('widgets.form._formitem_text', ['name' => 'link_fb', 'title' => 'link_fb', 'placeholder' => 'Facebook','class'=> "form-control" ])
                    </div>
                    <div class="col-md-4">
                        @include('widgets.form._formitem_text', ['name' => 'link_instagram', 'title' => 'link_instagram', 'placeholder' => 'Instagram','class'=> "form-control" ])
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-4 form-control-static">
                        <div class="{!! $errors->has('specialty_name_3') ? 'has-error' : null !!}">
                            <p>
                                <select size="1" name="region_1" class="regionId_first" required>
                                    <option value="0" selected>--Виберіть Область--</option>
                                    @foreach($region as $key )
                                        <option value="{{ $key->id }}">{{ $key->region_ua }}</option>
                                    @endforeach
                                </select>
                            @if( $errors->has('region_1'))
                                @foreach( $errors->get('region_1') as $error)
                                    <p class="help-block">
                                        {{$error}}
                                    </p>
                                @endforeach
                            @endif
                        </div>

                        <div class="first">
                                <span class="area_first">
                     @include('widgets.form._formitem_select_cities', ['name' => 'city_first', 'title' => 'city_first', 'placeholder' => '--Виберіть місто--' ])
                                </span>
                        </div>
                    </div>
                    <div class="col-md-4 form-control-static">

                        <div class="{!! $errors->has('specialty_name_3') ? 'has-error' : null !!}">
                            <p>

                                <select size="1" name="region_2" class="regionId_second" required>
                                    <option value="0">--Виберіть Область--</option>
                                    @foreach($region as $key )
                                        <option value={{ $key->id }} >{{ $key->region_ua }}</option>
                                    @endforeach

                                </select>
                            @if( $errors->has('region_2'))
                                @foreach( $errors->get('region_2') as $error)
                                    <p class="help-block">
                                        {{$error}}
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        <div class="second">
                            <span class="area_second">
@include('widgets.form._formitem_select_cities', ['name' => 'city_first', 'title' => 'city_first', 'placeholder' => '--Виберіть місто--' ])
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 form-control-static">

                        <div class="{!! $errors->has('specialty_name_3') ? 'has-error' : null !!}">
                            <p>
                                <select size="1" name="region_3" class="regionId_third" required>
                                    <option value="0">--Виберіть Область--</option>
                                    @foreach($region as $key )
                                        <option value={{ $key->id }} >{{ $key->region_ua }}</option>
                                    @endforeach
                                </select>
                            @if( $errors->has('region_3'))
                                @foreach( $errors->get('region_3') as $error)
                                    <p class="help-block">
                                        {{$error}}
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        <div class="third">
                             <span class="area_third">
                                 @include('widgets.form._formitem_select_cities', ['name' => 'city_first', 'title' => 'city_first', 'placeholder' => '--Виберіть місто--' ])
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
                        <p class="help-block">
                            {{$error}}
                        </p>
                    @endforeach
                @endif

            </div>

            <div class="controls">
                {!! Form::file('attachments[]', array('multiple'=>true)) !!}
                @if( $errors->has('attachments'))
                    @foreach( $errors->get('attachments') as $error)
                        <p class="help-block">
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