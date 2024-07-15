<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransferFailed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $mobile;
    public $source_card;
    public $destination_card;
    public $reason;

    public function __construct($mobile ,$source_card, $destination_card, $reason)
    {
        $this->mobile = $mobile;
        $this->source_card = $source_card;
        $this->destination_card = $destination_card;
        $this->reason = $reason;
    }

}
