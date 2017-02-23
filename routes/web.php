<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function ()
{
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

//    Route::get('notifications', [
//        'as' => 'notifications.recent',
//        'uses' => 'NotificationsController@recent'
//    ]);
//    Route::get('notification/{id}', [
//        'as' => 'notifications.get',
//        'uses' => 'NotificationsController@get'
//    ]);
//    Route::put('notifications/read', [
//        'as' => 'notifications.read',
//        'uses' => 'NotificationsController@markAsRead'
//    ]);
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'Customer']], function ()
{
    Route::get('projects/create', [
        'uses' => 'ProjectsController@create',
        'as' => 'project.create'
    ]);

    Route::post('projects/create', [
        'uses' => 'ProjectsController@createSave',
        'as' => 'project.create.save'
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
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'Freelancer']], function ()
{
    Route::post('/create-bid', [
        'uses' => 'BidsController@postCreateBid',
        'as' => 'bid.create'
    ]);

    Route::get('/delete-bid/{id}', [
        'uses' => 'BidsController@getDeleteBid',
        'as' => 'bid.delete'
    ]);

    Route::get('products/create', [
        'uses' => 'ProductController@create',
        'as' => 'shop.create'
    ]);

    Route::post('products/create', [
        'uses' => 'ProductController@createSave',
        'as' => 'shop.create.save'
    ]);
});

Route::get('language','AppController@language');

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('freelancers/', [
    'uses' => 'UsersController@freelancers',
    'as' => 'user.freelancers'
]);

Route::get('user/{id}', [
    'uses' => 'UsersController@show',
    'as' => 'user.show'
]);

Route::get('users/review', [
    'uses' => 'UsersController@review',
    'as' => 'user.review'
]);

Route::get('users/category/{slug}', [
    'uses' => 'UsersController@getCategory',
    'as' => 'user.cat'
]);

Route::get('projects', [
    'uses' => 'ProjectsController@index',
    'as' => 'projects'
]);

Route::get('project/{id}', [
    'uses' => 'ProjectsController@show',
    'as' => 'projects.show'
]);

Route::get('projects/category/{slug}', [
    'uses' => 'ProjectsController@getCategory',
    'as' => 'project.cat'
]);

Route::get('shop', [
    'uses' => 'ProductController@index',
    'as' => 'shop'
]);

Route::get('product/{id}', [
    'uses' => 'ProductController@show',
    'as' => 'shop.show'
]);

Route::get('shop/category/{slug}', [
    'uses' => 'ProductController@getCategory',
    'as' => 'shop.cat'
]);
