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
    return redirect('login');
});

Route::get('pc_page', function() {
    return view('pc.pc_page');
});

// Sign Up Route
Route::get('signup', 'MailController@index'); // ◯
Route::post('signup', 'MailController@post');
Route::get('provisional_registration', 'MailController@provisional_registration'); // ◯
Route::get('register/{token}', 'MailController@getToken');// ◯
Route::post('register/{token}', 'MailController@writeProfile');
Route::get('confirm', 'MailController@confirm'); // ◯
Route::get('already_mail_address_registered', 'MailController@already_mail_address_registered'); // ◯
Route::get('no_expiration_date', 'MailController@no_expiration_date'); // ◯

// Login Route
Route::get('login', 'LoginController@signinView'); // ◯
Route::post('login', 'LoginController@signin');

// Home Route
Route::get('home', 'HomeController@homeView'); // ◯
Route::get('logout', 'LoginController@logout');

// Password Reset Route
Route::get('password_reset', 'PasswordResetController@index'); // ◯
Route::post('password_reset', 'PasswordResetController@post');
Route::get('password_reset_main_mail', 'PasswordResetController@password_reset_main_mail_view'); // ◯
Route::get('password_reset/{resetToken}', 'PasswordResetController@edit'); // ◯
Route::post('password_reset/{resetToken}', 'PasswordResetController@update');
Route::get('not_password_reset', 'PasswordResetController@not_password_reset_view'); // ◯

Route::get('myProfile', 'ProfileController@profileGet'); // ◯
Route::get('editProfile', 'ProfileController@editProfileView'); // ◯
Route::post('editProfile', 'ProfileController@updateProfile');
Route::get('otherUserProfile/{id}', 'ProfileController@otherUserProfileView'); // ◯

// Search Route
Route::get('search', 'SearchController@user_search'); // ◯
Route::get('result_search', 'SearchController@resultView'); // ◯
Route::get('depaerment_search/{department_id}', 'SearchController@department_search');
Route::get('result_depaerment_search', 'SearchController@result_depaerment_search_view');

// Follow Request Route
Route::post('follow_request', 'FollowController@follow_request');

Route::post('home', 'FollowController@allow_follow_requests');
Route::post('home/request_user_delete', 'FollowController@do_not_allow_follow_requests');
Route::post('home/delete_follow_user', 'FollowController@delete_follow_user');

// ver2.0から追加する機能の仮ページ
Route::get('add_ver2.0_function', 'HomeController@still_add_function'); // ◯

// Chat Route
Route::get('chat/{id}', 'ChatController@chat');
Route::post('send_message', 'ChatController@send_message');
Route::get('chat_member', 'ChatController@chat_member_list_view');
