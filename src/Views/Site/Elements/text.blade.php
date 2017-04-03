<!-- SAMPLE NAME -->
<div class="form-group">
    <?php $site_name = $request->get($name) ? $request->get('$name') : @$site->$name ?>
    {!! Form::label($name, trans('site::site_admin.'.$name).':') !!}
    {!! Form::text($name, $site_name, ['class' => 'form-control', 'placeholder' => trans('site::site_admin.'.$name).'']) !!}
</div>
<!-- /SAMPLE NAME -->