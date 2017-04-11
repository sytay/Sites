# Sites

## Install Laravel File Manager
```bash
composer require unisharp/laravel-filemanager
```

## Open file `base.blade.php` in `\your-project\resources\views\vendor\laravel-authentication-acl\admin\layouts\base.blade.php`
```bash
{!! HTML::style('css/treeview.css') !!}
```

```php
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
{!! HTML::script('js/select2.js') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
{!! HTML::script('js/tinymce.js') !!}
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
```