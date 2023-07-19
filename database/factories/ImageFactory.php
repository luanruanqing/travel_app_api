<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listImage = [
            "flight/air-asia.png",
            "flight/batik-air.png",
            "flight/citilink.png",
            "flight/garuda-indonesia.png",
            "flight/lion-air.png",
            "hotel/h1.png",
            "hotel/h2.png",
            "hotel/h3.png",
            "hotel/h4.jpg",
            "location/dubai.png",
            "location/japan.png",
            "location/korea.png",
            "location/turkey.png",
            "room/r1.png",
            "room/r2.png",
            "room/r3.png",
            "travel/t1.jpg",
            "travel/t2.jpg",
            "travel/t3.jpg",
            "travel/t4.jpg",
            "travel/t5.jpg",
            "travel/t6.jpg",
            "travel/t7.jpeg",
            "travel/t8.jpg",
        ];
        return [
            'image_url' => fake()->randomElement($listImage)
        ];
    }
}
