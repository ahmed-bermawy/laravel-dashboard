<?php

namespace laravelDashboard\Packages;

class AdminLtePackage extends Package
{
    protected string $packageName = 'admin-lte';
    protected string $packagePath = '/node_modules/admin-lte';
    protected string $packageInstallerCommand = 'yarn add admin-lte';
}
