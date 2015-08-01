<?php
    /**
     * Author: Xavier Au
     * Date: 29/7/15
     * Time: 6:25 PM
     */

    namespace Xavierau\RoleBaseAuthentication;


    use Illuminate\Support\ServiceProvider;
    use Xavierau\RoleBaseAuthentication\Contracts\PermissionInterface;
    use Xavierau\RoleBaseAuthentication\Contracts\RoleInterface;

    class RoleBaseAuthenticationServiceProvider extends ServiceProvider
    {

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
            $this->app->bind( PermissionInterface::class , Permission::class);
            $this->app->bind( RoleInterface::class, Role::class);
        }

        public function boot()
        {
            view()->composer(
                'RoleBaseAuthentication.roles.*', 'Xavierau\RoleBaseAuthentication\ViewComposers\GetPermissionsComposer'
            );
            $this->publishes([
                __DIR__.'/database/migrations/' => database_path('migrations')
            ], 'migrations');
//            $this->publishes([
//                __DIR__.'/database/seeds/' => database_path('seeds')
//            ], 'seeds');
            $this->publishes([
                __DIR__.'/resources/views/' => base_path('resources/views/RoleBaseAuthentication')
            ], 'views');

            if (! $this->app->routesAreCached()) {
                require __DIR__.'/Routes/routes.php';
            }
        }
    }