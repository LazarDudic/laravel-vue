<?php

namespace App\Providers;

use App\Models\User;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
            // return true;
        });

        if (Schema::hasTable('permissions')) {
            foreach ((new PermissionService())->all() as $permission) {
                $permissionName = $permission->name;
                Gate::define($permissionName, function (User $user) use ($permissionName) {
                    return $user->hasPermission($permissionName);
                });
            }
        }
    }
}
