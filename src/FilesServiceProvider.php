<?php

namespace laravelDashboard;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use laravelDashboard\Console\Commands\Initialize;
use laravelDashboard\Console\Commands\Setup;

class FilesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->createEditPermissionMigration();

        /**
         * load commands from incubator package folders
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                Setup::class,
                Initialize::class
            ]);
        }

        $this->publishFiles();
        if (File::exists(base_path() . '/routes/dashboard/web.php')) {
            $this->loadFiles();
        }
    }

    public function publishFiles()
    {
        /**
         * Copy the package files, each file to its path
         * controllers, models, views, migrations, factories, seeders, assets, command
         */
        $this->publishes([
            __DIR__ . '/database/migrations/' => base_path('database/migrations/dashboard/'),
            __DIR__ . '/database/factories/' => base_path('database/factories/dashboard/'),
            __DIR__ . '/database/seeders/' => base_path('database/seeders/dashboard/'),
            __DIR__ . '/Models/' => base_path('app/Models/dashboard/'),
            __DIR__ . '/Http/Controllers/' => base_path('app/Http/Controllers/dashboard/'),
            __DIR__ . '/Http/Requests/' => base_path('app/Http/Requests/dashboard/'),
            __DIR__ . '/views/' => base_path('resources/views/dashboard/'),
            __DIR__ . '/assets/js/jquery' => base_path('public/js/dashboard'),
            __DIR__ . '/assets/img/' => base_path('public/img/dashboard'),
            __DIR__ . '/assets/css/' => base_path('public/css/dashboard'),
            __DIR__ . '/routes/' => base_path('routes/dashboard/'),
        ],
            'dashboard');
    }

    public function loadFiles()
    {
        $this->loadMigrationsFrom(base_path('database/migrations/dashboard/'));
        $this->loadViewsFrom(base_path('resources/views/dashboard/'), 'dashboard');
        $this->loadRoutesFrom(base_path('routes/dashboard/web.php'));
    }

    /**
     * check laravel version to change database seeds path
     * if laravel version not in [7.8]
     * else die
     */


    public function createEditPermissionMigration()
    {
        /**
         * get spatie permissions migration name if it found
         * then cast it name to array with
         *      index 0 => year
         *      index 1 => month
         *      index 2 => day
         * increment index 2 by 1
         * cast new array values to string and concatenate with migration name
         * create permission migration with new name
         *
         */
        $file = glob(base_path() . "/database/migrations/*create_permission_tables.php");
        if ($file) {
            $dateOfPermissionMigration = array_slice((explode('_', basename($file[0]))), 0, 4);
            $dateOfPermissionMigration[2] = (int)$dateOfPermissionMigration[2] + 1;
            $permissionMigrationNewName = implode('_', $dateOfPermissionMigration)
                . '_add_column_order_id_to_permissions_table.php';

            File::copy(__DIR__ . '/Packages/permissionMigration.txt',
                __DIR__ . '/database/migrations/' . $permissionMigrationNewName);
        }
    }
}



