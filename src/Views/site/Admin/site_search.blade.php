
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('site::site_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_site','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('site_name', trans('site::site_admin.site_name_label')) !!}
            {!! Form::text('site_name', @$params['site_name'], ['class' => 'form-control', 'placeholder' => trans('site::site_admin.site_name_placeholder')]) !!}
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('site::site_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


