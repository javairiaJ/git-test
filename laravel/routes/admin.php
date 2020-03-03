<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
////Admin user Routes
    Route::get('login', 'SignupController@login');
    Route::post('login', 'SignupController@postLogin');
    Route::post('logout', [
        'as' => 'admin.logout',
        'uses' => 'SignupController@logout'
    ]);
    Route::get('password/change', 'PasswordController@changePasswordForm');
    Route::post('password/update', 'PasswordController@updatePassword');
    Route::get('/', function() {
        return redirect('admin/dashboard');
    });
    Route::get('dashboard', 'DashboardController@index');
////  
    //Route::group(['middleware' => 'admin'], function() {
////Modules Routes
    Route::get('modules', 'ModulesController@index');
    Route::get('module/{id}', 'ModulesController@show');
    Route::get('modules/create', 'ModulesController@create');
    Route::post('module/insert', 'ModulesController@save');
    Route::get('module/edit/{id}', 'ModulesController@edit');
    Route::post('module/update/{id}', 'ModulesController@update');
    Route::get('modules/listing', 'ModulesController@listing');
    Route::get('module/delete/{id}', 'ModulesController@delete');
    Route::get('modules/assign', 'ModulesController@showAssign');
    Route::post('modules/assign', 'ModulesController@saveAssign');

    Route::get('module/user/delete/{id}', 'ModulesController@deleteAssignUserModule');
////
////Users Routes
    Route::get('users', 'UsersController@index');
    Route::get('user/{id}', 'UsersController@show');
    Route::get('users/create', 'UsersController@create');
    Route::post('user/insert', 'UsersController@save');
    Route::get('user/edit/{id}', 'UsersController@edit');
    Route::post('user/update/{id}', 'UsersController@update');
    Route::get('users/listing', 'UsersController@listing');
    Route::get('user/delete/{id}', 'UsersController@delete');
    Route::get('user/approve/{id}', 'UsersController@accept');
    Route::get('user/disapprove/{id}', 'UsersController@reject');
//    Route::get('importExport', 'UsersController@importExport');
//    Route::get('/download/{type}',  'UsersController@downloadExcel');
//    Route::post('/importExcel',  'UsersController@importExcel');
////
////Templates Routes
    Route::get('templates', 'TemplatesController@index');
    Route::get('template/{id}', 'TemplatesController@show');
    Route::get('templates/create', 'TemplatesController@create');
    Route::post('template/insert', 'TemplatesController@save');
    Route::get('templates/listing', 'TemplatesController@listing');
    Route::get('template/delete/{id}', 'TemplatesController@delete');
    Route::get('templates/assign', 'TemplatesController@showAssign');
    Route::post('templates/assign', 'TemplatesController@saveAssign');
    Route::get('template/view/{id}', 'TemplatesController@view');
    Route::get('template/user/delete/{id}', 'TemplatesController@deleteAssignUserTemplate');

    Route::post('templates/details/insert/{code}', 'TemplateDetailsController@saveTemplateDetails');
////
////Notifications Routes
    Route::get('notifications', 'NotificationsController@index');
    Route::get('notifications/listing', 'NotificationsController@listing');
    Route::get('notification/delete/{id}', 'NotificationsController@delete');
////

////Emails Routes
    Route::get('emails', 'EmailsController@index');
    Route::get('email/{id}', 'EmailsController@show');
    Route::get('emails/create', 'EmailsController@create');
    Route::post('emails/insert', 'EmailsController@save');
    Route::get('email/edit/{id}', 'EmailsController@edit');
    Route::post('email/update/{id}', 'EmailsController@update');
    Route::get('emails/listing', 'EmailsController@listing');
    Route::get('email/delete/{id}', 'EmailsController@delete');
    Route::get('emails/assign', 'EmailsController@showAssign');
    Route::post('emails/assign', 'EmailsController@saveAssign');
    Route::get('email/view/{id}', 'EmailsController@view');
    Route::get('email/template/delete/{id}', 'EmailsController@deleteAssignEmailTemplate');

////
    ////Email Configurations Routes
    Route::get('email-configurations', 'EmailConfigurationsController@index');
    Route::get('email-configuration/{id}', 'EmailConfigurationsController@show');
    Route::get('email-configurations/create', 'EmailConfigurationsController@create');
    Route::post('email-configurations/insert', 'EmailConfigurationsController@save');
    Route::get('email-configurations/edit/{id}', 'EmailConfigurationsController@edit');
    Route::post('email-configurations/update/{id}', 'EmailConfigurationsController@update');
    Route::get('email-configurations/listing', 'EmailConfigurationsController@listing');
    Route::get('email-configurations/delete/{id}', 'EmailConfigurationsController@delete');
    ////
}
);
