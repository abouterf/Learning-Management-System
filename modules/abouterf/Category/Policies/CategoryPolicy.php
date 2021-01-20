<?php

namespace abouterf\Category\Policies;

use abouterf\User\Models\User;
use abouterf\RolePermissions\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }
}
