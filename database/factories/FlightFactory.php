<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $arrivalTime = $this->faker->dateTimeBetween('now', '+1 month');
        return [
            'number'=>fake()->numberBetween(100,1000),
            'departure_city'=>fake()->city(),
            'arrival_city'=>fake()->city(),
            'departure_time' => $this->faker->dateTimeBetween($arrivalTime, '+1 month')->format('Y-m-d H:i:s'),
            'arrival_time' => $arrivalTime->format('Y-m-d H:i:s')
            //
        ];
    }
}
