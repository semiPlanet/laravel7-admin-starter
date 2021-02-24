<?php

Route::post('user/login','UserController@userLogin')->name('api.user-login');

Route::group(['prefix' => 'products'], function(){
    Route::get('{last_id?}', 'ProductController@products')->name('api.product-listing');
});

Route::group(['prefix' => 'order', 'middleware' => 'auth:api'], function(){
    Route::post('store', 'OrderController@store')->name('api.order-place');
});