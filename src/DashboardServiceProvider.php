<?php

namespace laravelDashboard;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/guards.php', 'auth.guards.admin');
        $this->mergeConfigFrom(__DIR__ . '/config/providers.php', 'auth.providers.admins');
        $this->mergeConfigFrom(__DIR__ . '/config/passwords.php', 'auth.passwords.admins');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}



