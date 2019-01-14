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

Route::get('/home', 'HomeController@index')
    ->name('home');


Auth::routes();
Route::get('profile', 'UserController@profile')
    ->name('user.profile');
Route::post('profile', 'UserController@update')
    ->name('user.update');
Route::get('profile/delete', 'UserController@delete')
    ->name('user.delete');


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


Route::get('home','ConversationController@read')
        ->name('conversation.list');
Route::post('home','ConversationController@store')
        ->name('conversation.store');
Route::get('home/conversation/{id}/delete','ConversationController@delete')
        ->name('conversation.delete');
Route::get('/home/conversation/{id}/members','ConversationController@conversationMembers')
    ->name('conversation.members');

Route::get('home/conversation/{id}/edit','ConversationController@show')
    ->name('show.conversation');
Route::post('/home/conversation/{id}/edit','ConversationController@updateConversation');






Route::get('home/conversation/{id}','MessageController@show')
        ->name('message.show');
Route::get('/home/conversation/{id}/read','MessageController@read')
        ->name('message.read');
Route::post('home/conversation/{id}/send','MessageController@store')
    ->name('message.store');


Route::get('/home/conversation/{id}/add','SearchController@addMember')
    ->name('add.members');
//Route::get('/home/conversation/{id}/search','SearchController@search')
//    ->name('search.user');


Route::get('/home/conversation/{id}/attachment','AttachmentController@show')
    ->name('att.read');
Route::get('/home/conversation/{id}/download','AttachmentController@download')
    ->name('att.download');

Route::get('/home/conversation/{id}/leave','ConversationController@leaveConversation')
    ->name('leave.conversation');





