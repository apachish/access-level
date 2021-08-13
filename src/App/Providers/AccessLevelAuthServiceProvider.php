<?php

namespace Apachish\AccessLevel\App\Providers;

use Apachish\AccessLevel\App\Policies\ItemPolicy;
use Apachish\AccessLevel\Models\Item;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;

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
        dd("1");
        $this->registerPolicies();
    }
}
