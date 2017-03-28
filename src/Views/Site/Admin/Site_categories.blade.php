@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('site::site_admin.page_list') }}
@stop

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-info">

            <div class="panel-heading">
                <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {!! $request->all() ? trans('site::site_admin.page_search') : trans('site::site_admin.page_list') !!}</h3>
            </div>

            <!--MESSAGE-->
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success flash-message">{!! $message !!}</div>
            @endif
            <!--MESSAGE-->

            <!--ERRORS-->
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger flash-message">{!! $error !!}</div>
            @endforeach
            @endif 
            <!--ERRORS-->
            <div class="panel-body">
                {!! Form::open(['route'=>['admin_site.categories.post'], 'method' => 'post'])  !!}
                {!! Form::hidden('site_id',@$site_id) !!}
                @include('site::site.admin.site_category_item')
                {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function () {
        return confirm("Are you sure to delete this item?");
    });
</script>
@stop