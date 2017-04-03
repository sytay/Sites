{!! Form::label('site_image', trans('site::site_admin.site_image').':') !!}
<div class="input-group">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
        </a>
    </span>
    <?php
    if (empty($site)) {
        $site_img = "";
    } else {
        $site_img = $site->site_image;
    }
    ?>
    {!! Form::text($name, $site_img, ['class' => 'form-control', 'id'=>'thumbnail']) !!}
</div>
<img id="holder" style="margin-top:15px;max-height:100px;" src="{{ $site_img }}">