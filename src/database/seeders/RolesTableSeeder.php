<?php

namespace Database\Seeders\dashboard;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /********************
         * insert roles in DB
         *******************/
        $roles = ['admin', 'supervisor', 'manager'];
        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role,
                    'guard_name' => $role
                ]
            );
        }
    }
}
