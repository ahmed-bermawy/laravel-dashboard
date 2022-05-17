<?php

namespace laravelDashboard\Packages;

class SpatiePermission extends Package
{
    protected string $packageName = 'Spatie Permission';
    protected string $packagePath = '/vendor/spatie/laravel-permission';
    protected string $packageInstallerCommand = 'composer require spatie/laravel-permission';
}
