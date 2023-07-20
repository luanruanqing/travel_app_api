<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listImage = [
            'location/dubai.png',
            'location/japan.png',
            'location/korea.png',
            'location/turkey.png',
        ];
        return [
            'name' => fake()->country(),
            'image_url' => fake()->randomElement($listImage),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'description' => fake()->text(200),
        ];
    }
}
