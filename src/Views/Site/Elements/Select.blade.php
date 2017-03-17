<!-- SITE LIST -->
<div class="form-group">
    <?php $site_name = $request->get('site_name') ? $request->get('site_name') : @$site->site_name ?>
    {!! Form::label('site_id', trans('site::site_admin.site_category_name').':') !!}
    {!! Form::select('site_id', @$categories, @$site->site_id, ['class' => 'form-control']) !!}
</div>
<!-- /SITE LIST -->