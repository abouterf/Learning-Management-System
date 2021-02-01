<?php


namespace abouterf\RolePermissions\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    const ROLE_TEACHER = 'teacher';
    static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ]
    ];
}
