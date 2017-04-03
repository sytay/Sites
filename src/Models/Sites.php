<?php

namespace Sites\Models;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model {

    protected $table = 'sites';
    public $timestamps = false;
    protected $fillable = [
        'site_name', 'site_url', 'site_image'
    ];
    protected $primaryKey = 'site_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_sites($params = array()) {
        $eloquent = self::orderBy('site_id');

        //site_name
        if (!empty($params['site_name'])) {
            $eloquent->where('site_name', 'like', '%'. $params['site_name'].'%');
        }

        $sites = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $sites;
    }
    
    public function get_site_name($site_id){
        $site_name = self::where('site_id', $site_id)->get();
        return $site_name[0]->site_name;
    }



    /**
     *
     * @param type $input
     * @param type $site_id
     * @return type
     */
    public function update_site($input) {
        $site_id = NULL;
        if (empty($site_id)) {
            $site_id = $input['site_id'];
        }

        $site = self::find($site_id);

        if (!empty($site)) {

            $site->site_name = $input['site_name'];
            $site->site_url = $input['site_url'];
            if($input['site_image'] != NULL){
                $site->site_image = $input['site_image'];
            }
            $site->save();

            return $site;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_site($input) {

        $site = self::create([
                    'site_name' => $input['site_name'],
                    'site_url' => $input['site_url'],
                    'site_image' => $input['site_image'],
        ]);
        
        return $site;
    }
}
