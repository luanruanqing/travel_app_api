<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'f_name' => "Administrator",
            'l_name' => "",
            'phone_number' => "389935504",
            'date_of_birth' => fake()->date(),
            'avatar' => "user/none-avatar.png",
            'is_phone_verified' => "on",
            'email' => "admin@dd.com",
            'email_verified_at' => now(),
            'password' => bcrypt("123456"),
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Location::factory(100)->create();
        \App\Models\Hotel::factory(100)->create();
        \App\Models\Flight::factory(100)->create();
        \App\Models\Image::factory(100)->create();
        \App\Models\Travel::factory(100)->create();
        \App\Models\Service::factory(100)->create();
        \App\Models\HotelImage::factory(100)->create();
        \App\Models\HotelService::factory(100)->create();
        \App\Models\TravelImage::factory(100)->create();
        \App\Models\Review::factory(100)->create();
        \App\Models\ImageReview::factory(100)->create();
        \App\Models\ImageReview::factory(100)->create();
        \App\Models\Room::factory(100)->create();
        \App\Models\RoomImage::factory(100)->create();
        \App\Models\RoomService::factory(100)->create();
        \App\Models\Booking::factory(100)->create();
    }
}
