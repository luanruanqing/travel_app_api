<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $listUser = User::pluck('id');
        return [
            'user_id' => fake()->randomElement($listUser),
            'card_number' => fake()->randomNumber(9),
            'cvv' => fake()->randomNumber(3),
            'expire_date' => fake()->date(),
            'country' => fake()->country(),
            'bank' => fake()->name(),
        ];
    }
}
