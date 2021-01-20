<?php

namespace abouterf\Course\Database\Seeds;

use abouterf\RolePermissions\Models\Permission as ModelsPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{

    public function run()
    {
        foreach (ModelsPermission::$permissions as $permission) {
            Permission::findOrCreate($permission);
        }


        Role::findOrCreate('teacher')->givePermissionTo(['teach']);
    }
}
