@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="panel-body">
            <h1>
                Create
            </h1>
            {!! Form::model($task, [
                'method' => 'PATCH',
                'route' => ['specialists.update', $task->id]
            ]) !!}
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
                {!! Form::text('specialty_name', null,['class'=>'form-control']) !!}
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
                {!! Form::label('city_first') !!}
                {!! Form::text('city_first', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city_second') !!}
                {!! Form::text('city_second', null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city_third') !!}
                {!! Form::text('city_third', null,['class'=>'form-control']) !!}
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