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
Route::get('profile/{id}/delete', 'UserController@delete')
    ->name('user.delete');


Route::get('profile/photo', 'PhotoController@index')
    ->name('photo.show');
Route::get('profile/photo/create', 'PhotoController@show')
    ->name('photo.create');
Route::post('profile/photo', 'PhotoController@store')
    ->name('photo.store');
Route::get('profile/photo/{id}', 'PhotoController@delete')
    ->name('photo.delete');
Route::get('profile/photo/profile/{id}', 'PhotoController@setProfilePhoto')
    ->name('profile.photo');


Route::get('home', 'ConversationController@index')
    ->name('conversation.list');
Route::post('home', 'ConversationController@store')
    ->name('conversation.store');

Route::group(['middleware' => ['belongs_to']], function () {

    Route::get('home/conversation/{id}/delete', 'ConversationController@delete')
        ->name('conversation.delete');
    Route::get('/home/conversation/{id}/members', 'ConversationController@conversationMembers')
        ->name('conversation.members');
    Route::get('home/conversation/{id}/edit', 'ConversationController@show')
        ->name('show.conversation');
    Route::post('/home/conversation/{id}/edit', 'ConversationController@updateConversation');

    Route::get('home/conversation/{id}', 'MessageController@show')
        ->name('message.show');
    Route::get('/home/conversation/{id}/read', 'MessageController@read')
        ->name('message.read');
    Route::post('home/conversation/{id}/send', 'MessageController@store')
        ->name('message.store');
    Route::get('home/conversation/{id}/messages/{messageId}', 'MessageController@delete')
        ->name('message.delete');

    Route::get('/home/conversation/{id}/attachment', 'AttachmentController@index')
        ->name('att.read');
    Route::get('/home/conversation/{id}/download/{attachment_id}', 'AttachmentController@download')
        ->name('att.download');

    Route::get('/home/conversation/{id}/leave', 'ConversationController@leaveConversation')
        ->name('leave.conversation');

    Route::get('/home/conversation/{id}/add', 'SearchController@inviteUser')
        ->name('add.members');

    Route::get('/home/conversation/{id}/comment/{messageId}', 'CommentController@messageComments')
        ->name('commentMessage.get');
    Route::post('/home/conversation/{id}/comment/{messageId}', 'CommentController@store')
        ->name('commentMessage.store');
});


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
Route::get('/users/{id}', 'UserController@show')
    ->name('search.user');


Route::group(['middleware' => ['is_admin']], function () {
    Route::get('admin/users', 'SearchController@userData')
        ->name('users.table');
    Route::get('admin/users/{id}', 'UserController@userDetails')
        ->name('search.user');

    Route::get('admin/conversations', 'SearchController@conversationData')
        ->name('conversation.table');
    Route::get('admin/conversations/data', 'SearchController@indexConversationData')
        ->name('conversation.data');
    Route::get('admin/conversations/{id}', 'ConversationController@conversationDetails');

    Route::get('admin/photos', 'SearchController@photoData')
        ->name('photos.table');
    Route::get('admin/photos/data', 'SearchController@indexPhotoData')
        ->name('photos.data');
    Route::get('admin/photos/{id}', 'PhotoController@photoDetails')
        ->name('show.photo');
    Route::get('admin/photos/{id}/delete', 'PhotoController@deleteFromAdmin')
        ->name('delete.photo');

    Route::get('admin/messages', 'SearchController@messageData')
        ->name('messages.table');
    Route::get('admin/messages/data', 'SearchController@indexMessageData')
        ->name('messages.data');
    Route::get('admin/messages/{id}', 'MessageController@messageDetails')
        ->name('show.message');
    Route::get('admin/messages/{id}/delete', 'MessageController@deleteFromAdmin')
        ->name('delete.message');

    Route::get('admin/attachments', 'SearchController@attachmentData')
        ->name('attachments.table');
    Route::get('admin/attachments/data', 'SearchController@indexAttachmentsData')
        ->name('attachments.data');
    Route::get('admin/attachment/{id}', 'AttachmentController@attachmentDetails')
        ->name('show.attachment');

});

Route::get('/users/add/{id}','ConversationController@messageSingleUser');



