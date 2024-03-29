<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event\Middleware;

use Psr\EventDispatcher\EventDispatcherInterface;
use Zorachka\Framework\MessageBus\Middleware\Middleware;

final class EventDispatcherMiddleware implements Middleware
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(object $input, callable $next): object
    {
        return $this->eventDispatcher->dispatch($input);
    }
}
