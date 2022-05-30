<?php

namespace Database\Factories\dashboard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BackendProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
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
    }
}
