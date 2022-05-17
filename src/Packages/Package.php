<?php

namespace laravelDashboard\Packages;

use Illuminate\Support\Facades\File;

class Package
{
    protected string $yesOrNo = "\e[0;32mYes\e[0m" . "/" . "\e[0;31mNo\e[0m" . "\n"; //to print green yes/red no
    protected array $yesArray = ['Y', 'y', 'Yes', 'yes', 'YES']; //read yes from user

    protected string $packageName;
    protected string $packagePath;
    protected string $packageInstallerCommand;

    public function install()
    {
        $packageFound = File::exists(base_path() . $this->packagePath);
        if (!$packageFound) {
            echo "\e[0;32m installing $this->packageName ... \e[0m\n";
            shell_exec($this->packageInstallerCommand);
            return;
        }
        echo "Do you want to install $this->packageName " . $this->yesOrNo;
        $input = readline();
        if (in_array($input, $this->yesArray)) {
            echo "\e[0;32m installing $this->packageName ... \e[0m\n";
            shell_exec($this->packageInstallerCommand);
        }
    }

    public static function install_package()
    {
        (new static())->install();
    }
}
