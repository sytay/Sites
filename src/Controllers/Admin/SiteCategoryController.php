<?php

namespace Sites\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
use Sites\Models\Sites;
use Sites\Models\SitesCategories;
use Works\Models\WorksCategories;
use Sites\Models\MapCategories;
/**
 * Validators
 */
use Sites\Validators\SiteAdminValidator;

class SiteCategoryController extends AdminController {

    public $data_view = array();
    private $obj_site = NULL;
    private $obj_site_categories = NULL;
    private $obj_validator = NULL;
    private $obj_work_category = NULL;
    private $obj_map_categories = NULL;

    public function __construct() {
        $this->obj_site_categories = new SitesCategories();
        $this->obj_work_category = new WorksCategories();
        $this->obj_map_categories = new MapCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();
        $site_id = $request->get('site_id');

        $sites_categories = $this->obj_site_categories->get_sites_categories($site_id);
        $this->data_view = array_merge($this->data_view, array(
            'sites_categories' => $sites_categories,
            'site_id' => $site_id,
            'request' => $request,
            'params' => $params
        ));
        return view('site::site.admin.site_categories', $this->data_view)
                        ->with('category_parent', $this->obj_work_category->get_categories_parent(0));
    }

    public function post(Request $request) {
        $this->obj_validator = new SiteAdminValidator();
        $site_id = $request->get('site_id');
        $sites_categories = $this->obj_site_categories->get_sites_categories($site_id);
        foreach ($sites_categories as $site_categories){
            $array_work_categories_id = $request->get('map_categories'.$site_categories->site_category_id);
            $this->obj_map_categories->add_map_category($site_categories->site_category_id, $array_work_categories_id);
        }
        $this->data_view = array_merge($this->data_view, array(
            'sites_categories' => $sites_categories,
            'site_id' => $site_id,
            'request' => $request
        ));
        return view('site::site.admin.site_categories', $this->data_view)
                        ->with('category_parent', $this->obj_work_category->get_categories_parent(0));
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $site = NULL;
        $site_id = $request->get('id');

        if (!empty($site_id)) {
            $site = $this->obj_site->find($site_id);

            if (!empty($site)) {
                //Message
                $this->addFlashMessage('message', trans('site::site_admin.message_delete_successfully'));

                $site->delete();
            }
        } else {
            
        }

        $this->data_view = array_merge($this->data_view, array(
            'site' => $site,
        ));

        return Redirect::route("admin_site");
    }

}
