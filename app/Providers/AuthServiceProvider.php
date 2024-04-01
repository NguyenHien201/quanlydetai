<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        View::composer('backend.layout', function ($view) {
            $user = Auth::user();
            $id = $user->id;
            $username = $user->username;
            $avatar = $user->avatar;
            $view->with('username', $username)->with('avatar', $avatar)->with('id', $id);
        });

        $this->registerPolicies();
        Gate::define('modules', function($user, $permissionName) {
            if($user->publish == 0) return false;
            $permission = $user->user_Catalogues->permissions;
            if($permission->contains('canonical', $permissionName)) {
                return true;
            }
            return false;
        });
    }
}
