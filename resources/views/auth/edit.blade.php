@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        {!! Form::open() !!}
                        {!! Form::model($task, [
                        'method' => 'PATCH',
                        'route' => ['specialists.update', $task->id]
                        ]) !!}
                        @include('widgets.form._formitem_text', ['name' => 'email', 'title' => 'Email', 'placeholder' => 'Email','class'=> "form-control" ])
                        @include('widgets.form._formitem_password', ['name' => 'password', 'title' => 'Пароль', 'placeholder' => 'Пароль' ])
                        @include('widgets.form._formitem_password', ['name' => 'password_confirm', 'title' => 'Подтверждение пароля', 'placeholder' => 'Пароль' ])
                        @include('widgets.form._formitem_btn_submit', ['title' => 'Регистрация'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
