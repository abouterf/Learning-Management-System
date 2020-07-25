<?php

Route::group(['namespace' => 'abouterf\Dashboard\Http\Controllers'], function ($router) {
    $router->get('/home', 'DashboardController@index')->name('home');
});
