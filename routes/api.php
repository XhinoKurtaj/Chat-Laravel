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
//->middleware('auth:api');

//->middleware('auth:api')

Route::post('/register', 'Api\UserController@Register');
Route::post('/login', 'Api\UserController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/logout', 'Api\UserController@logout');
    Route::get('users', 'Api\UserController@index');
    Route::put('users/{id}', 'Api\UserController@update');
    Route::delete('users/{id}', 'Api\UserController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users/photos', 'Api\PhotoController@show');
    Route::post('users/photos', 'Api\PhotoController@store');
    Route::delete('users/photos/{id}', 'Api\PhotoController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users/conversation/test', 'Api\ConversationController@index');
    Route::get('users/conversation', 'Api\ConversationController@show');
    Route::post('users/conversation', 'Api\ConversationController@store');
    Route::put('users/conversation/{id}', 'Api\ConversationController@update');
    Route::delete('users/conversation/{id}', 'Api\ConversationController@delete');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users/conversation/{id}/messages', 'Api\MessagesController@show');
    Route::post('users/conversation/{id}/messages', 'Api\MessagesController@store');
});