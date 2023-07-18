<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\Image;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomImage>
 */
class RoomImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listRoom = Room::pluck('id');
        $listImage = Image::pluck('id');
        return [
            'room_id' => fake()->randomElement($listRoom),
            'image_id' => fake()->randomElement($listImage)
        ];
    }
}
