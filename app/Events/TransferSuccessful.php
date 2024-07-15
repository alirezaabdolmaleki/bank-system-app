<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransferSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $senderMobile;
    public $reciverMobile;
    public $amount;
    public $id;

    public function __construct($senderMobile, $reciverMobile, $amount, $id)
    {
        $this->senderMobile = $senderMobile;
        $this->reciverMobile = $reciverMobile;
        $this->amount = $amount;
        $this->id = $id;
    }
}
