<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_card_id' => $this->faker->randomElement(Card::pluck('id')),
            'destination_card_id'=> $this->faker->randomElement(Card::pluck('id')),
            'amount' => rand(10000, 1000000), // مبلغ به تومان
        ];
    }
}
