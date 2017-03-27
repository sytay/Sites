<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapCategoriesTable extends Migration
{
       private $_table = NULL;
    private $fileds = NULL;

    public function __construct() {
        $this->_table = 'map_categories';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        /**
         * Existing table
         */

        
        if (!Schema::hasTable($this->_table)) {
            Schema::create($this->_table, function (Blueprint $table) {
                $table->increments('map_category_id');
            });
        }
        
        

        /**
         * Existing fields
         */
        //site_id

        
        if (!Schema::hasColumn($this->_table, 'map_category_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->increments('map_category_id');
            });
        }
        
        //site_name
        if (!Schema::hasColumn($this->_table, 'work_category_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('work_category_id', 255);
            });
        }
        
        //status_id
        if (!Schema::hasColumn($this->_table, 'site_category_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->integer('site_category_id')->default(0);
            });
        }
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_categories');
    }
}
