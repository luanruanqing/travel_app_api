<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listImage = [
            "service/ico_24hour.png",
            "service/ico_breakfast.png",
            "service/ico_currency.png",
            "service/ico_non_refund.png",
            "service/ico_non_smoke.png",
            "service/ico_restaurant.png",
            "service/ico_wifi.png"
        ];
        return [
            'name' => fake()->name(),
            'thumbnail' => fake()->randomElement($listImage),
            'description' => fake()->text(200),
        ];
    }
}
