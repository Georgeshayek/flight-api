<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $role = Role::create(['name' => 'flight booker']);
        $role1 = Role::create(['name' => 'flight creator']);
        $permission = Permission::create(['name' => 'join flight']);
        $permission1 = Permission::create(['name' => 'create flight']);
        $permission2 = Permission::create(['name' => 'edit flight']);
        $role->givePermissionTo($permission);
        $role1->syncPermissions($permission1,$permission2);
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
