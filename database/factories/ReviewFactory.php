<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Travel;
use App\Models\Room;
use App\Models\Flight;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listUser = User::pluck('id');
        $listHotel = Hotel::pluck('id');
        $listTravel = Travel::pluck('id');
        $listRoom = Room::pluck('id');
        $listFlight = Flight::pluck('id');
        return [
            'hotel_id' => fake()->randomElement($listHotel),
            'travel_id' => fake()->randomElement($listTravel),
            'user_id' => fake()->randomElement($listUser),
            'room_id' => fake()->randomElement($listRoom),
            'flight_id' => fake()->randomElement($listFlight),
            'review_text' => fake()->text(200),
            'rating' => fake()->randomNumber(1),
            'like' => fake()->randomNumber(1),
            'dislike' => fake()->randomNumber(1),
        ];
    }
}
