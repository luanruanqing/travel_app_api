<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
use App\Models\Service;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelService>
 */
class HotelServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listHotel = Hotel::pluck('id');
        $listService = Service::pluck('id');
        return [
            'hotel_id' => fake()->randomElement($listHotel),
            'service_id' => fake()->randomElement($listService)
        ];
    }
}
