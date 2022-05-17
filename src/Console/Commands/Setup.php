<?php

namespace laravelDashboard\Console\Commands;

use Illuminate\Console\Command;
use laravelDashboard\Packages\AdminLtePackage;
use laravelDashboard\Packages\Fontawesome;
use laravelDashboard\Packages\LaravelCollective;
use laravelDashboard\Packages\SpatiePermission;

class Setup extends Command
{
    protected $signature = 'dashboard:setup';

    protected $description = 'Setup Incubator Dashboard';

    public function handle()
    {
        AdminLtePackage::install_package();
        SpatiePermission::install_package();
        Fontawesome::install_package();
        LaravelCollective::install_package();
    }
}
