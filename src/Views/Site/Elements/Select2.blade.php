<!-- SITE LIST -->
<div class="form-group">
    <?php $name = 'map_categories'.$id; ?>
    {!! Form::select("$name". "[]", $category_parent, null, ['class'=>'form-control', 'id'=>"$name", 'multiple']) !!}
</div>
<!-- /SITE LIST -->