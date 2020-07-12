<?php
Route::group(['namespace' => 'abouterf\User\Http\Controllers',
    'middleware' => 'web'],
    function ($router) {
    Auth::routes(['verify' => true]);
    Route::post('email/verify','Auth\VerificationController@verify')->name('verification.verify');
});
