<?php

use abouterf\RolePermissions\Models\Permission;

Route::get('/', function () {
    return view('index');
});


Route::get('/test', function () {
    // auth()->user()->givePermissionTo('teach');
    //    return auth()->user()->permissions;
    // \Spatie\Permission\Models\Permission::create(['name' => 'manage cats']);
    auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS);
    // return auth()->user()->permissions;
});


//testing temporary signed route

/*Route::get('/test-verify/{user}/', function () {

if (request()->hasValidSignature()){
    return 'ok';
}
else return 'failed';
})->name('test-verify');

Route::get('/test', function () {
    $url = URL::temporarySignedRoute('test-verify', now()->addMinutes(5), ['user' => 5]);
    dd($url);
});*/

//testing temporary signed route


//testing email template

/*Route::get('/test', function () {
    return new \abouterf\User\Mail\VerifyCodeMail(236598);
});*/

//testing email template
