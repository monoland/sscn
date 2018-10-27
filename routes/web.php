<?php

Route::get('/', 'WebController@index');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/validate', 'Apis\RegisterController@resultcheck');
Route::get('/rekapitulasi', 'Apis\RecapsController@recapfilter');
Route::get('/cetak/{registrar}', 'Apis\RegisterController@download');
Route::get('/jadwal', 'WebController@schedule');
Route::get('/ujian', 'WebController@exam');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'AppController@dashboard');
    Route::get('/fail', 'AppController@fail');
    Route::get('/recaps', 'AppController@recaps');
    Route::get('/register', 'AppController@register');
    Route::get('/verify', 'AppController@verify');
    Route::get('/schedule', 'AppController@schedule');
});

Route::get('image/{template}/{filename}', '\Intervention\Image\ImageCacheController@getResponse');
