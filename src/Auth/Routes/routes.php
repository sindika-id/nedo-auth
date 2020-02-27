<?php

Route::group(['namespace' => '\Nedoquery\Auth\Controllers', 'middleware' => ['notloggedin', 'web']], function () {
    Route::get('auth/login', 'LoginController@getLogin')->name('login');
    Route::post('auth/login', 'LoginController@postLogin');
    Route::get('auth/logout', 'LoginController@getLogout');
    
    Route::get('auth/register', 'RegisterController@getRegister')->name('register');
    Route::post('auth/register', 'RegisterController@postRegister');
    
    Route::get('auth/forgotpass', 'ForgotPasswordController@getForgotPass')->name('forgotpass');
    Route::post('auth/forgotpass', 'ForgotPasswordController@postForgotPass');
});
