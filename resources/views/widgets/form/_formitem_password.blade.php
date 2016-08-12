<?php if(! isset($value)) $value = null ?>
<div class=" {!! $errors->has($name) ? 'has-error' : null  !!}">
    <label class="col-md-4 control-label" for="{!! $name !!}">{{ $title }}</label>
        <div class="col-md-6">
            {!! Form::password($name, $value, array('placeholder' =>  $placeholder,'class'=>"form-control" )) !!}
            <p class="help-block">{!! $errors->first($name) !!}</p>
        </div>
</div>