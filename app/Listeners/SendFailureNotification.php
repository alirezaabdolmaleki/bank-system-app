<?php

namespace App\Listeners;

use App\Events\TransferFailed;
use App\Services\Messaging\MessagingContext;
use App\Services\Messaging\MessagingService;
use App\Services\Messaging\MessagingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFailureNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(private MessagingService $messagingService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TransferFailed $event): void
    {
        $this->messagingService->sendMessage(
            $event->mobile,
            __('payment.error', ['error' => $event->reason])
        );
    }
}
