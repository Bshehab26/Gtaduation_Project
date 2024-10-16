<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
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
            'venue_image' => $this->faker->imageUrl(150, 100, 'venue', true),  // Fake image URL
            'phone'=> fake()->unique()->phoneNumber(),
           'city'=> fake()->city(),
           'address'=> fake()->address(),
           'capacity'=> fake()->randomNumber(),
        ];
    }
}
