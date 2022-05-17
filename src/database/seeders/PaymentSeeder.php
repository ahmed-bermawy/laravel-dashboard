<?php

namespace Database\Seeders\dashboard;

use App\Models\dashboard\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /********************
         * insert payments in DB
         *******************/
        $paymentNames = ['paypal', 'visa Card', 'master Card','Cash On Delivery '];
        foreach ($paymentNames as $paymentName) {
            Payment::updateOrCreate(
                [
                    'name' => $paymentName,
                ]
            );
        }
    }
}
