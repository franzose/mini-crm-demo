<?php

namespace CrmDemo\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use CrmDemo\Domain\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CrmDemo\Model' => 'CrmDemo\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit-users', function(User $user) {
            return $user->is('admin');
        });

        $gate->define('edit-entities', function(User $user) {
            return $user->is('admin');
        });

        $gate->define('filter-managers', function(User $user) {
            return $user->is('admin');
        });
    }
}
