<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween($min = 50, $max = 100);
        return [
            'type' => fake()->randomElement(['class_A', 'class_B', 'class_C']),
            'price' => fake()->randomNumber(2, 1),
            'quantity' => $quantity,
            'available' => $quantity,
        ];
    }
}
