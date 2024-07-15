<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'card_number' => rand(1235,9999) . rand(1235,9999) . rand(1235,9999) . rand(1235,9999),
            'balance'=> rand(1000000,10000000) . 000
        ];
    }
}
