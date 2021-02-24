<?php

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login','LoginController@login')->name('admin.login-check');
Route::post('logout', 'LoginController@logout')->name('admin.logout');
Route::get('/', 'HomeController@home')->name('admin.home');


Route::get('list-admins', 'UserController@listAdmins')->name('admin.list-admins');
Route::get('list-users', 'UserController@listUsers')->name('admin.list-users');

Route::group(['prefix'=> 'settings'], function(){
    Route::get('/', 'SettingController@index')->name('admin.settings');
    Route::post('store', 'SettingController@store')->name('admin.settings.store');
});