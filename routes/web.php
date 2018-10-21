<?php

Route::get('/', 'WebController@index');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/validate', 'Apis\RegisterController@resultcheck');
Route::get('/rekapitulasi', 'Apis\RecapsController@recapfilter');
Route::get('/cetak/{registrar}', 'Apis\RegisterController@download');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/fail', function () {
        return view('fail');
    });

    Route::get('/recaps', function () {
        return view('recaps');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::get('/verify', function () {
        return view('verify');
    });
});

Route::get('image/{template}/{filename}', '\Intervention\Image\ImageCacheController@getResponse');
