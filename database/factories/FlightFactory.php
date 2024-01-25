<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departure_time = $this->faker->dateTimeBetween('now', '+1 month');
        $min_arrival_time = Carbon::instance($departure_time)->addHour();
        $max_arrival_time = Carbon::instance($departure_time)->addDay();
        return [
            'number' => fake()->unique()->numberBetween(100, 1000),
            'departure_city' => fake()->city(),
            'arrival_city' => fake()->city(),
            'departure_time' => $departure_time->format('Y-m-d H:i:s'),
            'arrival_time' => $this->faker->dateTimeBetween($min_arrival_time, $max_arrival_time)->format('Y-m-d H:i:s')
        ];
    }
}
