<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\Service;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomService>
 */
class RoomServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listRoom = Room::pluck('id');
        $listService = Service::pluck('id');
        return [
            'room_id' => fake()->randomElement($listRoom),
            'service_id' => fake()->randomElement($listService)
        ];
    }
}
