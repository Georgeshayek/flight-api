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
            'FirstName'=>fake()->firstName(),
            'LastName'=>fake()->lastName(),
            'email'=>fake()->email(),
            'password'=>fake()->password(6,20),
            'DOB'=>fake()->date('Y-m-d',$max='now'),
            'passport_expiry_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d')
            //
        ];
    }
}
