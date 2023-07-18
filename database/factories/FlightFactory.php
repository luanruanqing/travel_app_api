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
        return [
            'name' => fake()->name(),
            'thumbnail' => fake()->imageUrl(100,100),
            'departure' => fake()->date(),
            'arrive' => fake()->date(),
            'code_flight' => fake()->countryCode(),
            'price' => fake()->randomNumber(5),
        ];
    }
}
