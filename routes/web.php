<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    CRUD::resource('projects', 'Admin\ProjectsCrudController');
    CRUD::resource('project_cats', 'Admin\ProjectCatsCrudController');
    CRUD::resource('users_cats', 'Admin\UserCatsCrudController');
    CRUD::resource('bids', 'Admin\BidsCrudController');
    CRUD::resource('product', 'Admin\ProductCrudController');
    CRUD::resource('product_cat', 'Admin\ProductCatCrudController');
    Route::get('projects/{id}/active', ['uses' => 'ProjectsController@activateProject', 'as' => 'projects.activate']);
});

Route::get('language','AppController@language');

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('projects', [
    'uses' => 'ProjectsController@index',
    'as' => 'projects'
]);

Route::get('projects/create', [
    'uses' => 'ProjectsController@create',
    'as' => 'project.create'
]);

Route::post('projects/create', [
    'uses' => 'ProjectsController@createSave',
    'as' => 'project.create.save'
]);

Route::get('project/{id}', [
    'uses' => 'ProjectsController@show',
    'as' => 'projects.show'
]);

Route::post('project/{id}/use_freelancer', [
    'uses' => 'ProjectsController@useFreelancer',
    'as' => 'project.use_freelancer'
]);

Route::post('project/{id}/completed', [
    'uses' => 'ProjectsController@completed',
    'as' => 'project.completed'
]);

Route::post('project/{id}/canceled', [
    'uses' => 'ProjectsController@canceled',
    'as' => 'project.canceled'
]);

Route::post('/create-bid', [
    'uses' => 'BidsController@postCreateBid',
    'as' => 'bid.create'
]);

Route::get('/delete-bid/{id}', [
    'uses' => 'BidsController@getDeleteBid',
    'as' => 'bid.delete'
]);

Route::get('projects/category/{slug}', [
    'uses' => 'ProjectsController@getCategory',
    'as' => 'project.cat'
]);

Route::get('dashboard', [
    'uses' => 'UsersController@dashboard',
    'as' => 'dashboard'
]);

Route::post('dashboard/save_basic', [
    'uses' => 'UsersController@saveBasic',
    'as' => 'account.save.basic'
]);

Route::post('dashboard/save_image', [
    'uses' => 'UsersController@saveImage',
    'as' => 'account.save.image'
]);

Route::post('dashboard/save_contacts', [
    'uses' => 'UsersController@saveContacts',
    'as' => 'account.save.contacts'
]);

Route::post('dashboard/save_pay', [
    'uses' => 'UsersController@savePay',
    'as' => 'account.save.pay'
]);

Route::get('user/{id}', [
    'uses' => 'UsersController@show',
    'as' => 'user.show'
]);

Route::get('freelancers/', [
    'uses' => 'UsersController@freelancers',
    'as' => 'user.freelancers'
]);

Route::get('users/review', [
    'uses' => 'UsersController@review',
    'as' => 'user.review'
]);

Route::get('users/category/{slug}', [
    'uses' => 'UsersController@getCategory',
    'as' => 'user.cat'
]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('notifications', [
        'as' => 'notifications.recent',
        'uses' => 'NotificationsController@recent'
    ]);
    Route::get('notification/{id}', [
        'as' => 'notifications.get',
        'uses' => 'NotificationsController@get'
    ]);
    Route::put('notifications/read', [
        'as' => 'notifications.read',
        'uses' => 'NotificationsController@markAsRead'
    ]);
});

Route::get('shop', [
    'uses' => 'ProductController@index',
    'as' => 'shop'
]);

Route::get('product/{id}', [
    'uses' => 'ProductController@show',
    'as' => 'shop.show'
]);