<?php

Route::group(['namespace' => 'abouterf\RolePermissions\Http\Controllers','middleware'=>['web','auth','verified']], function ($router) {
    $router->resource('role-permissions','RolePermissionsController');
});
