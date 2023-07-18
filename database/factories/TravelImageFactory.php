<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Travel;
use App\Models\Image;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelImage>
 */
class TravelImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listTravel = Travel::pluck('id');
        $listImage = Image::pluck('id');
        return [
            'travel_id' => fake()->randomElement($listTravel),
            'image_id' => fake()->randomElement(["8","9","10","11","12","13","14","15"])
        ];
    }
}
