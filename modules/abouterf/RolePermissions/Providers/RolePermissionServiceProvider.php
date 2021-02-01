<?php

namespace abouterf\RolePermissions\Providers;

use abouterf\RolePermissions\Models\Permission;
use abouterf\RolePermissions\Models\Role;
use abouterf\RolePermissions\Policies\RolePermissionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class RolePermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/role_permission_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'RolePermissions');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Gate::policy(Role::class, RolePermissionPolicy::class);
        Gate::before(function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_AMDIN) ? true : null;
        });
    }


    public function boot()
    {
        config()->set('sidebar.items.role-permissions', [
            'icon' => 'i-role-permissions',
            'title' => 'نقش های کاربری',
            'url' => route('role-permissions.index')
        ]);
    }
}
