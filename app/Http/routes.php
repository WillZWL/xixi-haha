<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * admin.
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('index', 'AdminController@index');
    Route::get('articles/index', 'ArticlesController@index');
    Route::get('articles/trash', 'ArticlesController@trash');
    Route::post('articles/restore/{id}', 'ArticlesController@restore');
    Route::delete('articles/forceDelete/{id}', 'ArticlesController@forceDelete');
    Route::resource('articles', 'ArticlesController');
    Route::get('settings/index', 'SettingsController@index');
    Route::patch('settings/index', 'SettingsController@update');
    Route::get('setting/flush', 'SettingsController@flush');
});

/*
 * auth
 */
Route::get('login', 'Admin\AuthController@getLogin');
Route::post('login', 'Admin\AuthController@postLogin');
Route::get('logout', 'Admin\AuthController@logout');

/*
 * home
 */
Route::group(['namespace' => 'Home'], function () {
    Route::resource('/', 'HomeController@index');
    Route::post('ajaxData', 'HomeController@ajaxData');
    Route::get('publish', 'PublishController@index');
    Route::post('publish/index', 'PublishController@store');
});
