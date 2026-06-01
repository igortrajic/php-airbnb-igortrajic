<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Model>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title'      => fake()->sentence(3),
        'city'       => fake()->city(),
        'price_night'=> fake()->randomFloat(2, 30, 500),
        'max_guests' => fake()->numberBetween(1, 10),
        'size'       => fake()->randomFloat(2, 20, 300),
        'owner_id'   => User::factory(),
    ];
    }
}
