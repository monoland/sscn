<?php

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/user', 'Account\UserController@show');
    Route::post('user/info', 'Account\UserController@info');
    Route::post('user/password', 'Account\UserController@password');
    Route::post('fail/{filename}/import', 'Apis\FailController@import');
    Route::resource('fail', 'Apis\FailController');
    Route::post('recaps/{filename}/import', 'Apis\RecapsController@import');
    Route::post('recaps/summary', 'Apis\RecapsController@summary');
    Route::resource('recaps', 'Apis\RecapsController');
    Route::post('register/{filename}/import', 'Apis\RegisterController@import');
    Route::post('register/timeline', 'Apis\RegisterController@timeline');
    Route::post('register/summary', 'Apis\RegisterController@summary');
    Route::resource('register', 'Apis\RegisterController');
    Route::post('verify/{filename}/import', 'Apis\VerifyController@import');
    Route::resource('verify', 'Apis\VerifyController');
});

Route::middleware('throttle:200,1')->group(function () {
    Route::post('media', 'Utility\MediaController@store');
    Route::delete('media/{media}', 'Utility\MediaController@destroy');
});
