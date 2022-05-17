<?php

namespace laravelDashboard\Traits;

use App\Models\dashboard\Admin;
use Illuminate\Support\Facades\Artisan;

trait ManageMigrations
{
    private array $seeds = [
        'PermissionsTableSeeder',
        'RolesTableSeeder',
        'AdminTableSeeder',
        'AssignRolePermissionSeeder',
        'PaymentSeeder'
    ];

    private function seedData()
    {
        if (Admin::count() >= 1) {
            $answer = $this->ask("\e[0;0mYou have already installed Incubator Dashboard, Do you want to continue \e[0m" .
                "\e[0;32mYes\e[0m" . "/" . "\e[0;31mNo\e[0m");
            if (!in_array($answer, $this->yes)) {
                return;
            }
        }

        foreach ($this->seeds as $seed) {
            Artisan::call("db:seed --class=\"Database\\\Seeders\\\dashboard\\\\$seed\"");
            $this->info("Seeding $seed ...");
        }
    }
}
