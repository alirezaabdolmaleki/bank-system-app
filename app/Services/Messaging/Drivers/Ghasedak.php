<?php

namespace App\Services\Messaging\Drivers;

use App\Services\Messaging\MessagingStrategyInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Ghasedak implements MessagingStrategyInterface
{

    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('sms.ghasedak.api_key');
    }

    public function send($recipient, $message)
    {
        Log::alert($recipient . "  " . $message);
        return true;
        // $response = Http::post('https://api.ghasedak.io/v2/sms/send/simple', [
        //     'receptor' => $recipient,
        //     'message' => $message,
        //     'apiKey' => $this->apiKey,
        // ]);

        // return $response->json();
    }
}
