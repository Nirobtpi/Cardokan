<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Gate::before(function ($user, $ability) {
        //     return $user->hasPermissionTo($ability) ? true : null;
        // });
        Gate::before(function ($admin, $ability) {
        if (!$admin instanceof Admin) {
           return null; // ignore if not Admin
        }

        // Super Admin handled in Admin::hasPermissionTo
        // Normal user handled in Admin::hasPermissionTo
         return $admin->hasPermissionTo($ability) ? true : false; // Laravel will now use Admin::can() method
    });
    }
}
