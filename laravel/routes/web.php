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
    return view('front.welcome');
});
// Authentication Routes...
//$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//
//// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset');
//Auth Routes
Route::get('login', 'SignupController@login')->name('login');
Route::post('login', 'SignupController@postLogin');
Route::get('register', 'SignupController@register')->name('register');
Route::post('register', 'SignupController@store');
Route::get('register/success/{id}', 'SignupController@success')->name('register/success/');
Route::get('register/verify/{confirmation_code}', 'SignupController@confirmEmail')->name('register/verify/');
Route::post('postsetpassword', 'SignupController@setPassword');


//Route::post('logout', [
//    'as' => 'logout',
//    'uses' => 'Auth\LoginController@logout'
//]);


Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');



//Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController']);
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('home', function () {
  return redirect('dashboard');
    //return redirect('admin');
return view('front.welcome');
});
//Route::group(['middleware' => 'restrict-admin'], function() {
//Users Routes
Route::get('/dashboard', 'UsersController@dashboard');
Route::get('profile', 'UsersController@profile');
Route::get('profile/edit', 'UsersController@editProfile');
Route::post('profile/update', 'UsersController@updateProfile');
Route::get('password/change', 'UsersController@changePasswordForm');
Route::post('password/update', 'UsersController@updatePassword');


//Notifications Routes
Route::get('notifications', 'NotificationsController@index')->name('notifications');
Route::get('notification/{id}', 'NotificationsController@show')->name('notificationShow');
Route::get('notifications/unseen', 'NotificationsController@unseen');
include("admin.php");
