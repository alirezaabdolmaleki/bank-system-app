<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\Card;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transfer(TransferRequest $request, TransferService $transferService)
    {
        try {
            $transferService->transfer(
                $request->source_card,
              $request->destination_card,
                $request->amount
            );

            return response()->json(['message' => 'Transfer successful']);
       } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
       }
    }
}
