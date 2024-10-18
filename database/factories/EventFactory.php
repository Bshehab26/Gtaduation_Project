<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->sentence();
        $start = fake()->dateTimeBetween('-1week', '+3days');
        $end = fake()->dateTimeBetween($start, '+1week');
        $status = '';
        switch ($start) {
            case now() < $start:
                $status = 'upcoming';
                break;
            case $start < now() && $end > now():
                $status = 'ongoing';
                break;
            case $end < now():
                $status = 'ended';
                break;
        };
        return [
            'name' => $name,
            'slug' => str_replace(' ', '-', $name),
            'subject' => fake()->sentence(4),
            'description' => implode('</p><p>', fake()->paragraphs(2)),
            'organizer_id' => User::factory()->create(['role' => 'organizer']),
            'venue_id' => fake()->numberBetween(1, 10),
            'start_time' => $start,
            'end_time' => $end,
            'status' => $status,
        ];
    }
}
