<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransferService
{
    public function transfer($source_card, $destination_card, $amount)
    {
        $fee = config('payment.cart.transaction.fee');

        DB::transaction(function () use ($source_card, $destination_card, $amount, $fee) {

            $fromAccount = Card::where('card_number', $source_card)->lockForUpdate()->firstOrFail();
            $toAccount = Card::where('card_number', $destination_card)->lockForUpdate()->firstOrFail();

            if ($fromAccount->balance < $amount + $fee) {
                throw new Exception('Insufficient balance');
            }

            $fromAccount->balance -= ($amount + $fee);
            $fromAccount->save();

            $toAccount->balance += $amount;
            $toAccount->save();

            $transaction = Transaction::create([
                'source_card_id' => $fromAccount->id,
                'destination_card_id' => $toAccount->id,
                'amount' => $amount,
            ]);

            $transaction->fee()->create(['amount' => $fee]);
        });
    }
}
