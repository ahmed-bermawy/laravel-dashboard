<?php

namespace Database\Seeders\dashboard;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /********************
         * generate permissions name
         *******************/
        $models = ['admin', 'role', 'permission','backendproduct'];
        $permissions = ['create', 'view', 'update', 'delete'];
        /********************
         * insert permissions in DB
         *******************/

        foreach ($models as $model) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $model . '-' . $permission,
                    'guard_name' => 'admin'
                ]);
            }
        }
    }
}
