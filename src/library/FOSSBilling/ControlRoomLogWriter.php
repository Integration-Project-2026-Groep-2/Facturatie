<?php

declare(strict_types=1);

namespace FOSSBilling;

class ControlRoomLogWriter
{
    public function write(array $event, string $channel = 'application'): void
    {
        try {
            $rabbit = new RabbitMQService();
            $level = $event['priorityName'] ?? 'INFO';
            $message = $event['message'] ?? '';
            
            $rabbit->logToControlRoom($level, $message);
        } catch (\Throwable) {
            // Silently fail if RabbitMQ is not available to avoid infinite loops or crashes during logging
        }
    }
}
