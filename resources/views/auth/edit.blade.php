


{!! Form::model($user, ['method' => 'PATCH','route' => ['auth.update', $user->id],'class'=>"form-signin",'files' => true,'enctype'=>"multipart/form-data"]) !!}

<div class="form-group">
    @include('widgets.form._formitem_text', ['name' => 'email', 'title' => 'Email', 'placeholder' => 'Email','class'=> "form-control" ])
</div>
<div class="form-group">
    @include('widgets.form._formitem_text', ['name' => 'first_name', 'title' => 'Email', 'placeholder' => 'Імя','class'=> "form-control" ])
    </div>
<div class="form-group">
    @include('widgets.form._formitem_text', ['name' => 'last_name', 'title' => 'Email', 'placeholder' => 'Прізвище','class'=> "form-control" ])
</div>
<div class="form-group">
    @include('widgets.form._formitem_text', ['name' => 'phone', 'title' => 'Email', 'placeholder' => 'Телефон','class'=> "form-control" ])
</div>
<div class="form-group">
    @include('widgets.form._formitem_password', ['name' => 'password', 'title' => 'Пароль', 'placeholder' => 'Пароль' ])
</div>
<div class="form-group">
    @include('widgets.form._formitem_password', ['name' => 'password_confirm', 'title' => 'Подтверждение пароля', 'placeholder' => 'Подтверждение пароля' ])
</div>

<div class="form-group">
    {!! Form::file('avatar', array('multiple'=>true)) !!}
</div>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
<div class="form-group">
    @include('widgets.form._formitem_btn_submit', ['title' => 'Редагування'])
</div>
{!! Form::close() !!}
