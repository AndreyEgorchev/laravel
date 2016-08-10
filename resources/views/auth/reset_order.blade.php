@extends('layouts.app')
@section('content')
    {!! Form::open() !!}
    @include('widgets.form._formitem_text', ['name' => 'email', 'title' => 'Email', 'placeholder' => 'Ваш Email' ])
    @include('widgets.form._formitem_btn_submit', ['title' => 'Сброс пароля'])
    {!! Form::close() !!}
@stop