<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\Review;

class ImageReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listImage = Image::pluck('id');
        $listReview = Review::pluck('id');
        return [
            'image_id' => fake()->randomElement($listImage),
            'review_id' => fake()->randomElement($listReview)
        ];
    }
}
