<?php

namespace abouterf\RolePermissions\Policies;

use abouterf\RolePermissions\Models\Permission;
use abouterf\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)) return true;
        return null;
    }
    public function create(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)) return true;
        return null;
    }
    public function edit(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)) return true;
        return null;
    }
    public function delete(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS)) return true;
        return null;
    }
}
