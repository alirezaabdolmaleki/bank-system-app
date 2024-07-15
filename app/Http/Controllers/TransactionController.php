<?php

namespace App\Http\Controllers;

use App\Events\TransferFailed;
use App\Events\TransferSuccessful;
use App\Http\Requests\TransferRequest;
use App\Models\Account;
use App\Models\Card;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transfer(TransferRequest $request, TransferService $transferService)
    {
        try {
            $transaction = $transferService->transfer(
                $request->source_card,
                $request->destination_card,
                $request->amount
            );
            $tr =   $transaction->load(['sourceCard.account.user', 'destinationCard.account.user']);

            event(new TransferSuccessful(
                $tr->sourceCard->account->user->mobile_number,
                $tr->destinationCard->account->user->mobile_number,
                $transaction->amount,
                $transaction->id
            ));

            return response()->json(['message' => 'Transfer successful']);
        } catch (Exception $e) {

            event(new TransferFailed(
                "09123456789", //Anyone who needs to be notified about it.
                $request->source_card,
                $request->destination_card,
                $e->getMessage()
            ));

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
