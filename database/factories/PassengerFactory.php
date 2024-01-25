<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->email(),
            'password' => fake()->password(6, 20),
            'date_of_birth' => fake()->date('Y-m-d', $max = 'now'),
            'passport_expiry_date' => $this->faker->dateTimeBetween('now', '+10 year')->format('Y-m-d')
            //
        ];
    }
}
