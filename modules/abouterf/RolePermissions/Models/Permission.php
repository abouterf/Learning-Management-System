<?php

namespace abouterf\RolePermissions\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

/*
we need to re-config the directory : 'config/permission' 
and introduce our Model to app. 
*/

class Permission extends ModelsPermission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage cats';
    const PERMISSION_MANAGE_COURSES = 'manage courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage own courses';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_SUPER_AMDIN = 'super admin';

    static $permissions = [
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES,
        self::PERMISSION_TEACH,
        self::PERMISSION_SUPER_AMDIN,
    ];
}
