<?php

namespace Sites\Models;

use Illuminate\Database\Eloquent\Model;

class Map_categories extends Model
{
    protected $table = 'map_categories';
    public $timestamps = false;
    protected $fillable = [
        'work_categories_id',
        'site_categories_id',
    ];

    public function get_sites_categories($site_categories_id) {
        
        $map_categories= self::where('site_categories_id', $site_categories_id)->get();
        
        return $map_categories;
    }

    /**
     *
     * @param type $input
     * @param type $work_id
     * @return type
     */
    public function delete_map_categorie($site_categories_id){
        self::where('site_categories_id', $site_categories_id)->delete();
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_map_category($site_categories_id, $array_work_categories_id) {

            foreach($array_work_categories_id as $categories){
                self::create([
                    'site_categories_id' => $site_categories_id,
                    'work_categories_id'=> $categories,
                ]);
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
