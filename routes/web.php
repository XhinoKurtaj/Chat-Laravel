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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('home/photo','PhotoController@show')
        ->name('photo.show');
Route::get('home/photo/create','PhotoController@create')
        ->name('photo.create');
Route::post('home/photo','PhotoController@store')
        ->name('photo.store');
Route::get('home/photo/{id}','PhotoController@delete')
        ->name('photo.delete');
Route::get('home/photo/profile/{id}','PhotoController@setProfilePhoto')
        ->name('profile.photo');


Route::get('home','ConversationController@read');
Route::post('home','ConversationController@store')
        ->name('conversation.store');

Route::get('home/conversation/{id}/delete','ConversationController@delete')
        ->name('conversation.delete');
Route::get('home/conversation/{id}','MessageController@show')
        ->name('message.show');
Route::post('home/conversation/{id}','MessageController@store')
        ->name('message.store');
Route::get('/home/conversation/{id}/read','MessageController@read')
        ->name('message.read');

Route::get('/home/conversation/{id}/members','ConversationController@conversationMembers')
        ->name('conversation.members');


Route::get('/home/conversation/{id}/add/member','SearchController@addMember')
    ->name('add.members');




Route::get('/home/conversation/{id}/search','SearchController@search')
    ->name('search.user');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');








