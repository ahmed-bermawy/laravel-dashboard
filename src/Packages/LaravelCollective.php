<?php

namespace laravelDashboard\Packages;

class LaravelCollective extends Package
{
    protected string $packageName = 'laravelcollective';
    protected string $packagePath = '/vendor/laravelcollective';
    protected string $packageInstallerCommand = 'composer require laravelcollective/html';
}
