@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('site::site_admin.page_edit') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($site->site_id) ? '<i class="fa fa-pencil"></i>'.trans('site::site_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('site::site_admin.form_add') !!}
                    </h3>
                </div>
                {{-- model general errors from the form --}}
                @if($errors->has('site_name') )
                <div class="alert alert-danger">{!! $errors->first('site_name') !!}</div>
                @endif

                @if($errors->has('name_unvalid_length') )
                <div class="alert alert-danger">{!! $errors->first('name_unvalid_length') !!}</div>
                @endif

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <h4>{!! trans('site::site_admin.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_site.post', 'id' => @$site->site_id],  'files'=>true, 'method' => 'post'])  !!}



                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        {!! trans('site::site_admin.tab_overview') !!}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#menu1">
                                        {!! trans('site::site_admin.tab_attributes') !!}
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <!--TEMPLATE OVERVIEW-->
                                <div id="home" class="tab-pane fade in active">
                                    <!-- SAMPLE NAME TEXT-->
                                    <!-- SITE NAME TEXT -->
                                    @include('site::site.elements.text', ['name' => 'site_name'])
                                    <!-- /END SITE NAME TEXT -->
                                    <!-- SITE URL TEXT -->
                                    @include('site::site.elements.text', ['name' => 'site_url'])
                                    <!-- /END SITE URL TEXT -->
                                    <!-- SITE IMAGE IMAGE -->
                                    @include('site::site.elements.image', ['name' => 'site_image'])
                                    <!-- /END SITE IMAGE IMAGE -->
                                    <!-- /END SAMPLE NAME TEXT -->
                                </div>

                                <!--TEMPLATE ATTRIBUTES-->
                                <div id="menu1" class="tab-pane fade">
                                    <!-- SAMPLE CATEGORIES TEXT-->
                                    @include('site::site.elements.text', ['name' => 'attributes'])
                                    <!-- /END SAMPLE CATEGORIES TEXT-->
                                </div>

                            </div>





                            {!! Form::hidden('id',@$site->site_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_site.delete',['id' => @$site->site_id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-4'>
            @include('site::site.admin.site_search')
        </div>

    </div>
</div>
@stop