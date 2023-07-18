<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Room;
use App\Models\Travel;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listTravel = Travel::pluck('id');
        $listHotel = Hotel::pluck('id');
        $listFlight = Flight::pluck('id');
        $listRoom = Room::pluck('id');
        $listUser = User::pluck('id');
        return [
            'travel_id' => fake()->randomElement($listTravel),
            'hotel_id' => fake()->randomElement($listFlight),
            'room_id' => fake()->randomElement($listRoom),
            'user_id' => fake()->randomElement($listUser),
            'flight_id' => fake()->randomElement($listHotel),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'guest' => fake()->randomNumber(1),
            'guest_name' => fake()->firstName(),
            'guest_email' => fake()->email(),
            'total_amount' => fake()->randomNumber(5),
            'room_quality' => fake()->randomNumber(1),
            'payment_method'=> fake()->randomNumber(1),
            'card_name'=> fake()->firstName(1),
            'card_number'=> fake()->randomNumber(9),
            'card_cvv'=> fake()->randomNumber(3),
            'card_expiration'=> fake()->randomNumber(1)
        ];
    }
}
