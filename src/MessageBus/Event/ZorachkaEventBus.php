<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;

final class ZorachkaEventBus implements EventBus
{
    public function __construct(
        private Broker $broker,
    ) {
    }

    /**
     * @param object[] $events
     * @return void
     */
    public function dispatch(array $events): void
    {
        $dispatch = $this->broker;
        foreach ($events as $event) {
            $dispatch($event);
        }
    }
}
