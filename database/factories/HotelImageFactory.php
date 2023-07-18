<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
use App\Models\Image;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelImage>
 */
class HotelImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listHotel = Hotel::pluck('id');
        $listImage = Image::pluck('id');
        return [
            'hotel_id' => fake()->randomElement($listHotel),
            'image_id' => fake()->randomElement($listImage)
        ];
    }
}
