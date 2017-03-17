<div class="form-group">
    <?php $site_name = $request->get('site_name') ? $request->get('site_name') : @$site->site_name ?>
    {!! Form::label('site_image', trans('site::site_admin.site_image').':') !!}
    {!! Form::file('site_image', ['class' => 'form-control'] ) ; !!}
</div>

