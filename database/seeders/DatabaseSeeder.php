<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();
            \App\Models\Passenger::factory(1000)->create();
            \App\Models\Flight::factory(50)->create();
            $flights = \App\Models\Flight::all();
            \App\Models\Passenger::all()->each(function ($passenger) use ($flights) { 
                $passenger->flights()->attach(
                    $flights->random(rand(1, 3))->pluck('id')->toArray()
                ); 
            });
        
    }
}
