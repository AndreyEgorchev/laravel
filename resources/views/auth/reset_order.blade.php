@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Reset password</div>
                <div class="panel-body">
                    {!! Form::open() !!}
                    @include('widgets.form._formitem_text', ['name' => 'email', 'title' => 'Email', 'placeholder' => 'Ваш Email' ])
                    @include('widgets.form._formitem_btn_submit', ['title' => 'Сброс пароля'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop