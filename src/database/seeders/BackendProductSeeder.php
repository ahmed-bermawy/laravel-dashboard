<?php

namespace Database\Seeders\dashboard;


use App\Models\dashboard\BackendProduct;
use Illuminate\Database\Seeder;

class BackendProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BackendProduct::factory(100)->create();
    }
}
