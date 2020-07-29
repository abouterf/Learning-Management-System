<?php

Route::group(['namespace' => 'abouterf\Dashboard\Http\Controllers','middleware'=>['web','auth','verified']], function ($router) {
    $router->get('/home', 'DashboardController@index')->name('home');
});
