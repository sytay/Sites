<?php

namespace Sites\Models;

use Illuminate\Database\Eloquent\Model;

class Sites_categories extends Model
{
    protected $table = 'sites_categories';
    public $timestamps = false;
    protected $fillable = [
        'site_category_name',
        'site_category_status',
    ];
    protected $primaryKey = 'site_category_id';

    public function get_sites_categories($params = array()) {
        $eloquent = self::orderBy('site_category_id');

        if (!empty($params['site_id'])) {
            $eloquent->where('site_id', 'like', $params['site_id']);
        }
        $sites_categories = $eloquent->paginate(10);
        return $sites_categories;
    }

    public function get_categories_parent($category_id) {
        $sites_categories = $this->where('category_id', '!=', $category_id)->get();
        $list = NULL;
        $list[0] = "(None)";
        $this->get_childs_category($sites_categories, 0, $list, 0);
        
        return $list;
    }

    public function get_childs_category($sites_categories, $category_parent, &$list, $level) {
        foreach ($sites_categories as $category) {
            if ($category->category_parent == $category_parent) {
                $name = "";
                for($i = 0; $i < $level; $i++){
                    $name .= '- ';
                }
                $name .= $category->category_name;
                $list[$category->category_id] = $name;
                $next_level = $level + 1;
                $this->get_childs_category($sites_categories, $category->category_id, $list, $next_level);
            }
            
        }
    }

    public function childs() {
        return $this->hasMany('Works\Models\WorksCategories', 'category_parent', 'category_id');
    }

    public function root_category() {
        return $this->where('category_parent', '=', 0)->get();
    }

    /**
     *
     * @param type $input
     * @param type $work_id
     * @return type
     */
    public function update_category($input, $category_id = NULL) {

        if (empty($category_id)) {
            $category_id = $input['category_id'];
        }

        $category = self::find($category_id);

        if (!empty($category)) {

            $category->category_name = $input['category_name'];
            $category->category_parent = $input['category_parent'];
            $category->category_description = $input['category_description'];
            $category->save();

            return $category;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
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
