<?php

namespace Coderstm\Providers;

use Coderstm\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CoderstmPermissionsServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('permissions')) {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->scope, function ($user) use ($permission) {
                    return $user->hasPermission($permission->scope);
                });
            });

            //Blade directives
            Blade::directive('group', function ($group, $guard = 'users') {
                return "if(guard() == {$guard} && current_user()->hasGroup({$group})) :"; //return this if statement inside php tag
            });

            Blade::directive('endgroup', function ($group) {
                return "endif;"; //return this endif statement inside php tag
            });
        }
    }
}
