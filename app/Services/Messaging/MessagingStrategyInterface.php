<?php

namespace App\Services\Messaging;

interface MessagingStrategyInterface
{
    public function send($recipient, $message);
}
