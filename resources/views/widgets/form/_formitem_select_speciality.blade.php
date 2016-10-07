<?php if(! isset($value)) $value = null ?>
<div class="{!! $errors->has($name) ? 'has-error' : null !!}">
    {!! Form::select($name,$speciality,null,['placeholder' => $placeholder,'class'=>'special_select_1']) !!}
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>