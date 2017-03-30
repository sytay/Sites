<?php

namespace Sites\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
use Sites\Models\Sites;
use Sites\Models\WorksCategories;
use Sites\Models\SitesCategories;
/**
 * Validators
 */
use Sites\Validators\SiteAdminValidator;

class SiteController extends AdminController {

    public $data_view = array();
    private $obj_site = NULL;
    private $obj_site_categories = NULL;
    private $obj_validator = NULL;
    private $obj_work_category = NULL;

    public function __construct() {
        $this->obj_site = new Sites();
        $this->obj_site_categories = new SitesCategories();
        $this->obj_work_category = new \Works\Models\WorksCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_site = $this->obj_site->get_sites($params);

        $this->data_view = array_merge($this->data_view, array(
            'sites' => $list_site,
            'request' => $request,
            'params' => $params
        ));
        return view('site::site.admin.site_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $site = NULL;
        $site_id = (int) $request->get('id');
        $sites_categories = $this->obj_site_categories->get_sites_categories($site_id);

        if (!empty($site_id) && (is_int($site_id))) {
            $site = $this->obj_site->find($site_id);
        }

        $this->obj_site_categories = new Sites();

        $this->data_view = array_merge($this->data_view, array(
            'sites_categories' => $sites_categories,
            'site_id' => $site_id,
            'site' => $site,
            'request' => $request
        ));
        return view('site::site.admin.site_edit', $this->data_view)
                ->with('category_parent', $this->obj_work_category->get_categories_parent(0));
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new SiteAdminValidator();

        $site_id = (int) $request->get('id');
        $site_name = $request->get('site_name');
        $site_url = $request->get('site_url');
        $site_image = NULL;
        $site = NULL;
        if ($request->hasFile('site_image')){
            if ($request->file('site_image')->isValid()) {
                $image = $request->file('site_image');
                $filename = $site_name . "." . $image->extension();
                $image->storeAs('public/images', $filename);
                $site_image = 'images/'.$filename;
            }
        }
        $input['site_name'] = $site_name;
        $input['site_url'] = $site_url;
        $input['site_image'] = $site_image;
        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($site_id) && is_int($site_id)) {

                $site = $this->obj_site->find($site_id);
            }
        } else {
            if (!empty($site_id) && is_int($site_id)) {
                $site = $this->obj_site->find($site_id);

                if (!empty($site_id) && is_int($site_id)) {

                    $input['site_id'] = $site_id;
                    $site = $this->obj_site->update_site($input);

                    //Message
                    $this->addFlashMessage('message', trans('site::site_admin.message_update_successfully'));
                    return Redirect::route("admin_site.edit", ["id" => $site_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('site::site_admin.message_update_unsuccessfully'));
                }
            } else {
                $site = $this->obj_site->add_site($input);

                if (!empty($site)) {

                    //Message
                    $this->addFlashMessage('message', trans('site::site_admin.message_add_successfully'));
                    return Redirect::route("admin_site.edit", ["id" => $site->site_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('site::site_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'site' => $site,
            'request' => $request,
                ), $data);
        return view('site::site.admin.site_edit', $this->data_view);
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
