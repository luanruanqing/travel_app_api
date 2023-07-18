<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listLocation = Location::pluck('id');
        return [
            'location_id' => fake()->randomElement($listLocation),
            'name' => fake()->country(),
            'address' => fake()->address(),
            'price' => fake()->randomNumber(5),
            'description' => fake()->text(200),
        ];
    }
}
