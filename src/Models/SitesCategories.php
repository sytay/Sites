<?php

namespace Sites\Models;

use Illuminate\Database\Eloquent\Model;

class SitesCategories extends Model {

    protected $table = 'sites_categories';
    public $timestamps = false;
    protected $fillable = [
        'site_category_name',
        'site_category_status',
    ];
    protected $primaryKey = 'site_category_id';

    public function get_sites_categories($site_id) {
        $eloquent = self::orderBy('site_category_id');
        $eloquent->where('site_id', $site_id);
        $sites_categories = $eloquent->paginate(10);
        return $sites_categories;
    }

    public function add_category($input) {

        $category = self::create([
                    'category_name' => $input['category_name'],
                    'category_parent' => $input['category_parent'],
                    'category_description' => $input['category_description'],
                    'category_status' => $input['category_status'],
        ]);
        return $category;
    }

    /**
     * Get list of sites categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect() {
        return $this->pluck('category_name', 'category_id')->all();
    }

}
