<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Middleware;

use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Zorachka\Framework\MessageBus\Command\Event\CommandFailed;
use Zorachka\Framework\MessageBus\Command\Event\CommandHandled;
use Zorachka\Framework\MessageBus\Command\Event\CommandReceived;
use Zorachka\Framework\MessageBus\Middleware\Middleware;

final class EventMiddleware implements Middleware
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(object $input, callable $next): mixed
    {
        try {
            $this->eventDispatcher->dispatch(CommandReceived::withCommand($input));
            $returnValue = $next($input);
            $this->eventDispatcher->dispatch(CommandHandled::withCommand($input));

            return $returnValue;
        } catch (Exception $exception) {
            $this->eventDispatcher->dispatch(CommandFailed::with($input, $exception));
            throw $exception;
        }
    }
}
