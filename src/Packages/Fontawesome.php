<?php

namespace laravelDashboard\Packages;

class Fontawesome extends Package
{
    protected string $packageName = 'fontawesome';
    protected string $packagePath = '/node_modules/@fortawesome/fontawesome-free';
    protected string $packageInstallerCommand = 'yarn add @fortawesome/fontawesome-free';
}
