<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Broker;

use SplQueue;

final class SplQueueBrokerFactory
{
    private function __construct()
    {
    }

    public static function create(array $middlewares): SplQueueBroker
    {
        $queue = new SplQueue();
        foreach ($middlewares as $middleware) {
            $queue->push($middleware);
        }

        return new SplQueueBroker($queue);
    }
}
