<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
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
            'destination' => fake()->name(),
            'description' => fake()->text(200),
        ];
    }
}
