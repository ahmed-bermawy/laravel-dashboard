<?php

namespace laravelDashboard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use laravelDashboard\Traits\ManageMigrations;

class Initialize extends Command
{
    use ManageMigrations;


    protected $signature = 'dashboard:seed';
    private array $yes = ['Y', 'y', 'Yes', 'yes', 'YES']; //read yes from user

    protected $description = 'migrate dashboard migration and seed data ';

    public function handle()
    {
        $this->seedData();
        $this->editLaravelMixer();
    }

    private function editLaravelMixer()
    {
        //add  assets files to webpack.mix.js file
        $assets = "\n \n // Dashboard files mixer \n" .
            "mix.js('vendor/ahmed-bermawy/laravel-dashboard/src/assets/js/dashboard/dashboard.js','public/js/dashboard'); \n" .
            "mix.sass('vendor/ahmed-bermawy/laravel-dashboard/src/assets/sass/dashboard.scss','public/css/dashboard');\n";

        $webpackMixPath = base_path() . '/webpack.mix.js';
        if (!str_contains(file_get_contents($webpackMixPath), $assets))
            File::append(base_path() . '/webpack.mix.js', $assets);
    }
}
