<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'BlogController@index');
    Route::resource('blog', '\App\Http\Controllers\BlogController');
    Route::post('comment/blog/{blog}', 'CommentController@store')->name('comment.store');
    Route::auth();
});

Route::group(array('prefix' => 'api/v1'), function() {
    Route::resource('authenticate', '\App\Http\Controllers\Api\V1\AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', '\App\Http\Controllers\Api\V1\AuthenticateController@authenticate');
    Route::resource('blog', '\App\Http\Controllers\Api\V1\BlogController');
});
