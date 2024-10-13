<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name'=> fake()->words(3, true),
           'phone'=> fake()->unique()->phoneNumber(),
           'city'=> fake()->city(),
           'address'=> fake()->address(),
           'capacity'=> fake()->randomNumber(),
        ];
    }
}
