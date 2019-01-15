<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', 'Api\UserController@Register');
Route::post('/login', 'Api\UserController@login');
Route::group(['middleware' => 'auth:api'], function() {
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/logout', 'Api\UserController@logout');
    Route::get('users', 'Api\UserController@index');
    Route::put('users', 'Api\UserController@update');
    Route::delete('users', 'Api\UserController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users/photos', 'Api\PhotoController@show');
    Route::post('users/photos', 'Api\PhotoController@store');
    Route::delete('users/photos/{id}', 'Api\PhotoController@delete');
});

    Route::group(['prefix' => 'users/conversation'], function() {

        Route::get('/test', 'Api\ConversationController@index');
        Route::get('/', 'Api\ConversationController@show');
        Route::post('/', 'Api\ConversationController@store');
        Route::put('/{id}', 'Api\ConversationController@update');
        Route::delete('/{id}', 'Api\ConversationController@delete');


        Route::group(['prefix' => '/{conversation_id}/messages'], function() {
            Route::get('/', 'Api\MessagesController@index');
//            Route::get('/{id}', 'Api\MessagesController@show');
            Route::post('/', 'Api\MessagesController@store');

        });
    });
});