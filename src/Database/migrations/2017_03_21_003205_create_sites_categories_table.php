<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesCategoriesTable extends Migration
{
    private $_table = NULL;
    private $fileds = NULL;

    public function __construct() {
        $this->_table = 'sites_categories';
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
                $table->increments('site_category_id');
            });
        }
        
        

        /**
         * Existing fields
         */
        //site_id

        
        if (!Schema::hasColumn($this->_table, 'site_category_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->increments('site_category_id');
            });
        }
        
        if (!Schema::hasColumn($this->_table, 'site_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->integer('site_id');
            });
        }
        
        //site_name
        if (!Schema::hasColumn($this->_table, 'site_category_name')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('site_category_name', 255);
            });
        }
        
         if (!Schema::hasColumn($this->_table, 'site_category_status')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->integer('site_category_status')->default(1);
            });
        }
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sites_categories');
    }
}
