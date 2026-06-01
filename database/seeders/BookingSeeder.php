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
            'id_user'      => fn () => $users->isNotEmpty() ? $users->random()->id : User::factory(),
            'apartment_id' => fn () => $apartments->isNotEmpty() ? $apartments->random()->id : Apartment::factory(),
        ]);
    }
}