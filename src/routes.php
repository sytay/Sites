<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 
Route::get('site', [
    'as' => 'site',
    'uses' => 'Sites\Controllers\Front\SampleFrontController@index'
]);*/


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/site', [
            'as' => 'admin_site',
            'uses' => 'Sites\Controllers\Admin\SiteController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/site/edit', [
            'as' => 'admin_site.edit',
            'uses' => 'Sites\Controllers\Admin\SiteController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/site/edit', [
            'as' => 'admin_site.post',
            'uses' => 'Sites\Controllers\Admin\SiteController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/site/delete', [
            'as' => 'admin_site.delete',
            'uses' => 'Sites\Controllers\Admin\SiteController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/work_category', [
            'as' => 'admin_work_category',
            'uses' => 'Sites\Controllers\Admin\WorkCategoryController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/work_category/edit', [
            'as' => 'admin_work_category.edit',
            'uses' => 'Sites\Controllers\Admin\WorkCategoryController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/work_category/edit', [
            'as' => 'admin_work_category.post',
            'uses' => 'Sites\Controllers\Admin\WorkCategoryController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/work_category/delete', [
            'as' => 'admin_work_category.delete',
            'uses' => 'Sites\Controllers\Admin\WorkCategoryController@delete'
        ]);
        
        Route::get('storage/images/{file}', ['as' => 'file_preview', 'uses' => 'Sites\Controllers\Admin\AdminController@preview']);
        
        
        /**
         * list
         */
         Route::get('admin/work', [
            'as' => 'admin_work',
            'uses' => 'Sites\Controllers\Admin\WorkController@index'
        ]);
         /**
         * edit-add
         */
        Route::get('admin/work/edit', [
            'as' => 'admin_work.edit',
            'uses' => 'Sites\Controllers\Admin\WorkController@edit'
        ]);
        
         /**
         * post
         */
         Route::post('admin/work/edit', [
            'as' => 'admin_work.post',
            'uses' => 'Sites\Controllers\Admin\WorkController@post'
        ]);
         
         /**
         * delete
         */
        
        Route::get('admin/work/delete', [
            'as' => 'admin_work.delete',
            'uses' => 'Sites\Controllers\Admin\WorkController@delete'
        ]);
    });
});
