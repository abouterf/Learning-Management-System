<?php

Route::group(['namespace' => 'abouterf\Category\Http\Controllers','middleware'=>['web','auth','verified']], function ($router) {
    $router->resource('categories','CategoryController')->middleware('permission:manage cats');
});
