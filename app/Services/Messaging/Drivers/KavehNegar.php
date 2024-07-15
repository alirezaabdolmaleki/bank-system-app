<?php

namespace App\Services\Messaging\Drivers;

use App\Services\Messaging\MessagingStrategyInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KavehNegar implements MessagingStrategyInterface
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('sms.kaveh_negar.api_key');
    }

    public function send($recipient, $message)
    {
        Log::alert($recipient . "  " . $message);
        return true;
        // $response = Http::get("https://api.kavenegar.com/v1/{$this->apiKey}/sms/send.json", [
        //     'receptor' => $recipient,
        //     'message' => $message,
        // ]);

        // return $response->json();
    }
}
