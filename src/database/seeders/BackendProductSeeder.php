<?php

namespace Database\Seeders\dashboard;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class BackendProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\dashboard\BackendProduct::factory(100)->create();
    }
}
