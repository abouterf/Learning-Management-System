<?php

namespace abouterf\RolePermissions\Http\Controllers;

use abouterf\Category\Responses\AjaxResponse;
use abouterf\RolePermissions\Http\Requests\RoleRequest;
use abouterf\RolePermissions\Http\Requests\RoleUpdateRequest;
use abouterf\RolePermissions\Repositories\PermissionRepo;
use abouterf\RolePermissions\Repositories\RoleRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController
{

    private $roleRepo;

    private $permissionRepo;

    public function __construct(RoleRepo $roleRepo, PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;

        $this->permissionRepo = $permissionRepo;

    }

    public function index()
    {
        $permissions = $this->permissionRepo->all();
        $roles = $this->roleRepo->all();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepo->create($request);
    }

    public function edit($roleId)
    {
        $role = $this->roleRepo->findById($roleId);
        $permissions = $this->permissionRepo->all();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $this->roleRepo->update($id, $request);

        return redirect(route('role-permissions.index'));
    }

    public function destroy($roleId)
    {
        $this->roleRepo->delete($roleId);
        return AjaxResponse::successResponse();
    }
}
