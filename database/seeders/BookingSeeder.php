<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Apartment;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users      = User::all();
        $apartments = Apartment::all();

        Booking::factory(10)->create([
            'id_user'      => fake()->randomElement($users->pluck('id')->toArray()),
            'apartment_id' => fake()->randomElement($apartments->pluck('id')->toArray()),
        ]);
    }
}