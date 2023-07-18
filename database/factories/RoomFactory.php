<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listHotel = Hotel::pluck('id');
        return [
            'hotel_id' => fake()->randomElement($listHotel),
            'name' => fake()->country(),
            'price' => fake()->randomNumber(5),
            'description' => fake()->text(200),
            'size' => fake()->randomNumber(1),
        ];
    }
}
