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
    Route::get('user/logout', 'Api\UserController@logout');
    Route::get('user', 'Api\UserController@index');
    Route::put('user', 'Api\UserController@update');
    Route::delete('user', 'Api\UserController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('user/photos', 'Api\PhotoController@index');
    Route::post('user/photos', 'Api\PhotoController@store');
    Route::delete('user/photos/{photo_id}', 'Api\PhotoController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'user/conversation'], function () {

        Route::get('/all', 'Api\ConversationController@index');
        Route::get('/', 'Api\ConversationController@show');
        Route::post('/', 'Api\ConversationController@store');
        Route::post('/{conversation_id}', 'Api\ConversationController@update');
        Route::delete('/{conversation_id}', 'Api\ConversationController@delete');

        Route::group(['prefix' => '/{conversation_id}/messages'], function () {
            Route::get('/', 'Api\MessagesController@index');
            Route::post('/', 'Api\MessagesController@store');
        });

        Route::group(['prefix' => '/{conversation_id}/attachment'], function () {
            Route::get('/', 'Api\AttachmentController@index');
            Route::get('/{attachment_id}', 'Api\AttachmentController@download');
        });
    });
});
