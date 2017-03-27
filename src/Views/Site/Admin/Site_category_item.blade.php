@if( ! $sites_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('site::site_admin.order') }}</td>
            <th style='width:45%'>Category name</th>
            <th style='width:45%'>Map category</th>
            <th style='width:20%'>{{ trans('site::site_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $sites_categories->toArray();

        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($sites_categories as $site_category)
        <tr>
            <td>
                <?php echo $counter;
                $counter++ ?>
            </td>
            <td>{!! $site_category->site_category_name !!}</td>
            <td>
                <!--<div class="form-group">
                    <select id="map_categories" name="map_categories[]" class="form-control" multiple></select>
                </div>-->
                @include('site::site.elements.select2', ['id' => $site_category->site_category_id])
            </td>
            <td>
                <a href="{!! URL::route('admin_site.edit', ['id' => $site_category->site_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_site.delete',['id' =>  $site_category->site_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<span class="text-warning">
    <h5>
        {{ trans('site::site_admin.message_find_failed') }}
    </h5>
</span>
@endif
<div class="paginator">
    {!! $sites_categories->appends($request->except(['page']) )->render() !!}
</div>