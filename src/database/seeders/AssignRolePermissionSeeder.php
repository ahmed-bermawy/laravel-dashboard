<?php

namespace Database\Seeders\dashboard;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        foreach ($roles as $role) {
            if ($role->name === 'admin') {
                foreach ($permissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
