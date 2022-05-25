<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

$factory->define(\App\Models\dashboard\BackendProduct::User::class, function (Faker $faker) {
    return [
        'name' => $this->faker->sentence(4),
        'short_description' => $this->faker->sentence(20),
        'description' => $this->faker->realText(1000),
        'image' => $this->faker->image,
        'file' => '',
        'group_id' => rand(1,2),
        'free_delivery' => rand(0,1),
        'release_date' => Carbon::now(),
        'publish_date' => Carbon::now(),
        'password' => Hash::make(Str::random(8)),
        'property_id' => Str::random(8),
    ];
});