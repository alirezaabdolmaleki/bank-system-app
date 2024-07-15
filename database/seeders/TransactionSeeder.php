<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Fee;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory()->count(10)->create()->each(function ($transaction) {
            //Balance cards after transaction

            $destination_card = Card::find($transaction->destination_card_id);
            $destination_card->balance = $destination_card->balance + $transaction->amount;
            $destination_card->save();

            $source_card = Card::find($transaction->source_card_id);
            $source_card->balance = $source_card->balance - $transaction->amount - config('payment.fee');
            $source_card->save();

            $transaction->fee()->create(['amount' => config('payment.fee')]);
        });
    }
}
