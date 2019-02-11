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


Route::get('profile/photo','PhotoController@index')
        ->name('photo.show');
Route::get('profile/photo/create','PhotoController@show')
        ->name('photo.create');
Route::post('profile/photo','PhotoController@store')
        ->name('photo.store');
Route::get('profile/photo/{id}','PhotoController@delete')
        ->name('photo.delete');
Route::get('profile/photo/profile/{id}','PhotoController@setProfilePhoto')
        ->name('profile.photo');


Route::get('home','ConversationController@index')
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
///////////////
Route::get('home/conversation/{id}/messages/{messageId}','MessageController@delete')
    ->name('message.delete');

Route::get('/home/conversation/{id}/attachment','AttachmentController@index')
    ->name('att.read');
Route::get('/home/conversation/{id}/download/{attachment_id}','AttachmentController@download')
    ->name('att.download');


Route::get('/home/conversation/{id}/leave','ConversationController@leaveConversation')
    ->name('leave.conversation');

Route::get('/login/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\FacebookController@handleProviderCallback');


Route::get('/admin', 'UserController@admin')
    ->middleware('is_admin')
    ->name('admin');
Route::get('/admin', 'UserController@index')
    ->middleware('is_admin')
    ->name('admin');


Route::get('users', 'SearchController@create')
    ->name('data.table');
Route::get('users/data', 'SearchController@index')
    ->name('data');
Route::get('/users/{id}','UserController@show')
    ->name('search.user');
Route::get('/users/add/{id}','ConversationController@messageSingleUser');

Route::get('/home/conversation/{id}/add','SearchController@inviteUser')
    ->name('add.members');