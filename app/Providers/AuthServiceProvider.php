<?php

namespace App\Providers;

use App\Entities\Role;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Passport::routes();

        // Passport::useClientModel(Client::class);
        // Passport::useTokenModel(TokenModel::class);
        // Passport::useAuthCodeModel(AuthCode::class);
        // Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        // Passport::enableImplicitGrant();
        // Passport::personalAccessClientId('client-id');


        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));


        // Passport::loadKeysFrom('/secret-keys/oauth');

        // Grant "Super Admin" users all permissions (assuming they are verified using can() and other gate-related functions):

        Gate::before(function ($user, $ability) {
            /**
             * Allow everything to supper-admin role
             */
//            if ($user->hasRole('supper-admin')) {
//                return true;
//            }
        });

    }
}
