<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Apartment::factory(10)->create([
            'owner_id' => fn () => $users->isNotEmpty() ? $users->random()->id : User::factory(),
        ]);
    }
}
