<?php if(! isset($value)) $value = null ?>
<div class="{!! $errors->has($name) ? 'has-error' : null !!}">
    {!! Form::select($name,[],null,['placeholder' => $placeholder,'class'=>'regionId_first']) !!}
    <p class="help-block">{!! $errors->first($name) !!}</p>
</div>