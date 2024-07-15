<?php

namespace App\Listeners;

use App\Events\TransferSuccessful;
use App\Services\Messaging\MessagingContext;
use App\Services\Messaging\MessagingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSuccessNotification implements ShouldQueue
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
    public function handle(TransferSuccessful $event): void
    {
        $this->messagingService->sendMessage($event->senderMobile, __('payment.success.sender', ["id" => $event->id]));
        $this->messagingService->sendMessage($event->reciverMobile,  __('payment.success.reciver', ["id" => $event->id]));
    }
}
