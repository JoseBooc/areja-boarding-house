<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-tenants', function ($user) {
            return in_array($user->role, ['admin','staff']);
        });

        Gate::define('assign-rooms', function ($user) {
            return in_array($user->role, ['admin','staff']);
        });

        Gate::define('view-repairs', function ($user) {
            return in_array($user->role, ['admin','staff']);
        });

        Gate::define('view-admin-dashboard', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('view-staff-dashboard', function ($user) {
            return in_array($user->role, ['admin','staff']);
        });

        Gate::define('view-tenant-dashboard', function ($user) {
            return $user->role === 'tenant';
        });

        Gate::define('tenant-self', function ($user) {
            return $user->role === 'tenant';
        });
    }
}
