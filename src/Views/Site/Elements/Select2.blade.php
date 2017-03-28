<!-- SITE LIST -->
<div class="form-group">
    <?php $name = 'map_categories'.$id;
    $map_array = Sites\Models\MapCategories::get_mapped_categories($id);?>
    {!! Form::select("$name". "[]", $category_parent, $map_array, ['class'=>'form-control', 'id'=>"$name", 'multiple']) !!}
</div>
<!-- /SITE LIST -->