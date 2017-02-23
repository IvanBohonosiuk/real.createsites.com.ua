<?php

Route::group(['prefix' => config('backpack.base.route_prefix'), 'middleware' => ['admin', 'roles'], 'roles' => 'admin'], function()
{
    if (config('backpack.base.setup_dashboard_routes')) {
        Route::get('dashboard', '\Backpack\Base\app\Http\Controllers\AdminController@dashboard');
        Route::get('/', '\Backpack\Base\app\Http\Controllers\AdminController@redirect');
    }
    // Custom Routes
    CRUD::resource('projects', 'Admin\ProjectsCrudController');
    CRUD::resource('project_cats', 'Admin\ProjectCatsCrudController');
    CRUD::resource('users_cats', 'Admin\UserCatsCrudController');
    CRUD::resource('bids', 'Admin\BidsCrudController');
    CRUD::resource('product', 'Admin\ProductCrudController');
    CRUD::resource('product_cat', 'Admin\ProductCatCrudController');
    Route::get('projects/{id}/active', ['uses' => 'ProjectsController@activateProject', 'as' => 'projects.activate']);
    Route::get('product/{id}/active', ['uses' => 'ProductController@activateProduct', 'as' => 'products.activate']);

    // Language
    Route::get('language/texts/{lang?}/{file?}', '\Backpack\LangFileManager\app\Http\Controllers\LanguageCrudController@showTexts');
    Route::post('language/texts/{lang}/{file}', '\Backpack\LangFileManager\app\Http\Controllers\LanguageCrudController@updateTexts');
    Route::resource('language', '\Backpack\LangFileManager\app\Http\Controllers\LanguageCrudController');
    // Backup
    Route::get('backup', '\Backpack\BackupManager\app\Http\Controllers\BackupController@index');
    Route::put('backup/create', '\Backpack\BackupManager\app\Http\Controllers\BackupController@create');
    Route::get('backup/download/{file_name?}', '\Backpack\BackupManager\app\Http\Controllers\BackupController@download');
    Route::delete('backup/delete/{file_name?}', '\Backpack\BackupManager\app\Http\Controllers\BackupController@delete')->where('file_name', '(.*)');
    // Logs
    Route::get('log', '\Backpack\LogManager\app\Http\Controllers\LogController@index');
    Route::get('log/preview/{file_name}', '\Backpack\LogManager\app\Http\Controllers\LogController@preview');
    Route::get('log/download/{file_name}', '\Backpack\LogManager\app\Http\Controllers\LogController@download');
    Route::delete('log/delete/{file_name}', '\Backpack\LogManager\app\Http\Controllers\LogController@delete');
    // User Routes
    CRUD::resource('permission', '\Backpack\PermissionManager\app\Http\Controllers\PermissionCrudController');
    CRUD::resource('role', '\Backpack\PermissionManager\app\Http\Controllers\RoleCrudController');
    CRUD::resource('user', '\Backpack\PermissionManager\app\Http\Controllers\UserCrudController');
});

// File manager
Route::group(['prefix' => config('elfinder.route.prefix'), 'middleware' => ['admin', 'roles'], 'roles' => 'admin'], function ()
{
    Route::get('/',  ['as' => 'elfinder.index', 'uses' =>'\Barryvdh\Elfinder\ElfinderController@showIndex']);
    Route::any('connector', ['as' => 'elfinder.connector', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showConnector']);
    Route::get('popup/{input_id}', ['as' => 'elfinder.popup', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showPopup']);
    Route::get('filepicker/{input_id}', ['as' => 'elfinder.filepicker', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showFilePicker']);
    Route::get('tinymce', ['as' => 'elfinder.tinymce', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showTinyMCE']);
    Route::get('tinymce4', ['as' => 'elfinder.tinymce4', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showTinyMCE4']);
    Route::get('ckeditor', ['as' => 'elfinder.ckeditor', 'uses' => '\Barryvdh\Elfinder\ElfinderController@showCKeditor4']);
});