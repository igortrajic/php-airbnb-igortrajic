<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Apartment;
use App\Models\Booking;

/** @extends Factory<Booking> */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn  = fake()->dateTimeBetween('+1 week', '+1 month');
        $checkOut = fake()->dateTimeBetween($checkIn, '+2 months');

        return [
        'status'      => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
        'check_in'    => $checkIn,
        'check_out'   => $checkOut,
        'total_price' => fake()->randomFloat(2, 50, 5000),
        'id_user'     => User::factory(),
        'apartment_id'=> Apartment::factory(),
        ];
    }
}
