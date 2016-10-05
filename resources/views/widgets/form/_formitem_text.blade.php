<?php if(! isset($value)) $value = null ?>
<div class="{!! $errors->has($name) ? 'has-error' : null !!}">
    {!! Form::text($name, $value, array('placeholder' => $placeholder,'class'=>"form-control" )) !!}
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>