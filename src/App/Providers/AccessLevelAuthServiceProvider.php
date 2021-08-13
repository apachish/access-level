<?php

namespace Apachish\AccessLevel\App\Providers;

use Apachish\AccessLevel\App\Policies\ItemPolicy;
use Apachish\AccessLevel\Models\Item;
use Apachish\AccessLevel\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;
use function Symfony\Component\String\s;

class AccessLevelAuthServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Item::class => ItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::define('user-admin', function (User $user) {
            return $user->roles()->where("name", ["admin"])->count();
        });
        $this->registerPolicies();
    }
}
