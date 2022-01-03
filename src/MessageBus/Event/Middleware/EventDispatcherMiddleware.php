<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event\Middleware;

use Psr\EventDispatcher\EventDispatcherInterface;
use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

final class EventDispatcherMiddleware implements Middleware
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(Input $event, Broker $next): ?Output
    {
        $this->eventDispatcher->dispatch($event);

        return null;
    }
}
