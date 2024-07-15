<?php

namespace App\Http\Controllers;

use App\Events\TransferFailed;
use App\Events\TransferSuccessful;
use App\Http\Requests\TransferRequest;
use App\Models\Account;
use App\Models\Card;
use App\Models\User;
use App\Services\TransferService;
use Carbon\Carbon;
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

    public function getTopUsers()
    {
        // Define the time ten minutes ago
        $tenMinutesAgo = Carbon::now()->subMinutes(10);

        // Retrieve the top three users with the most transactions in the last 10 minutes
        $topUsers = User::with(['accounts.cards' => function($query) use ($tenMinutesAgo) {
            // Load source and destination transactions for each card within the last 10 minutes
            $query->with(['sourceTransactions' => function($query) use ($tenMinutesAgo) {
                $query->where('created_at', '>=', $tenMinutesAgo)->orderBy('created_at', 'desc')->take(10);
            }, 'destinationTransactions' => function($query) use ($tenMinutesAgo) {
                $query->where('created_at', '>=', $tenMinutesAgo)->orderBy('created_at', 'desc')->take(10);
            }]);
        }])
        ->get()
        ->sortByDesc(function ($user) {
            // Sort users by the total number of transactions in descending order
            return $user->accounts->sum(function ($account) {
                return $account->cards->sum(function ($card) {
                    return $card->sourceTransactions->count() + $card->destinationTransactions->count();
                });
            });
        })
        ->take(3);

        // Calculate the number of transactions and get the last 10 transactions for each user
        $topUsers = $topUsers->map(function ($user) {
            $transactionCount = 0;
            $user->accounts->each(function ($account) use (&$transactionCount) {
                $account->cards->each(function ($card) use (&$transactionCount) {
                    $transactionCount += $card->sourceTransactions->count() + $card->destinationTransactions->count();
                });
            });
            // Add the transaction count to the user object
            $user->transaction_count = $transactionCount;
            return $user;
        });

        // Convert the collection to an array without numerical keys
        $topUsersArray = $topUsers->values()->all();

        // Return the users as a JSON response
        return response()->json($topUsersArray);
    }
}
