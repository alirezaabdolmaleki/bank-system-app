<?php

namespace App\Services\Messaging;

class MessagingService
{
    protected $strategy;

    public function __construct(MessagingStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function sendMessage($recipient, $message)
    {
        return $this->strategy->send($recipient, $message);
    }
}
