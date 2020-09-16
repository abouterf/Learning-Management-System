<?php

namespace abouterf\RolePermissions\Http\Controllers;

use abouterf\RolePermissions\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController
{

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {

    }
}
