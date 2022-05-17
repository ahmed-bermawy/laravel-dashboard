<?php

namespace Database\Seeders\dashboard;


use App\Models\dashboard\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*********
         * Admin Data
         *******/
        $adminData = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
        /** create admin */
        $admin = Admin::where('email', $adminData['email'])->first();

        if ($admin !== null) {
            $admin->update($adminData);
        } else {
            $admin = Admin::create($adminData);
        }
        /** assign admin role to admin */
        $admin->assignRole(1);
        $this->command->info('Seeding Admin ...');
    }
}
