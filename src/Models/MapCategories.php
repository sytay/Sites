<?php

namespace Sites\Models;

use Illuminate\Database\Eloquent\Model;

class MapCategories extends Model {

    protected $table = 'map_categories';
    public $timestamps = false;
    protected $fillable = [
        'work_category_id',
        'site_category_id',
    ];

    public static function get_mapped_categories($site_category_id) {
        $mapped_categories = self::where('site_category_id', $site_category_id)->get();
        $map_arr = NULL;
        foreach ($mapped_categories as $category) {
            $map_arr[] += $category->work_category_id;
        }
        return $map_arr;
    }

    /**
     *
     * @param type $input
     * @param type $work_id
     * @return type
     */
    public function delete_map_categorie($site_categories_id) {
        self::where('site_categories_id', $site_categories_id)->delete();
    }

    public function add_map_category($site_categories_id, $array_work_categories_id) {
        self::where('site_category_id', $site_categories_id)->delete();
        if (!empty($array_work_categories_id)) {
            foreach ($array_work_categories_id as $categories) {
                self::create([
                    'site_category_id' => $site_categories_id,
                    'work_category_id' => $categories,
                ]);
            }
        }
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
