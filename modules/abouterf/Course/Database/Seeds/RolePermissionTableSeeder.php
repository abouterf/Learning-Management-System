<?php

namespace abouterf\Course\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionTableSeeder extends Seeder
{

    public function run()
    {
        Permission::findOrCreate('manage categories');
        Permission::findOrcreate('manage role_permissions');
        Permission::findOrcreate('teach');

        Role::findOrCreate('teacher')->givePermissionTo(['teach']);
    }
}
