<?php

Route::group(['namespace' => 'abouterf\Course\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('courses', 'CourseController');
});
