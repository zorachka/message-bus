<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Middleware;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

final class CommandHandlerMiddleware implements Middleware
{
    /**
     * @param array<class-string, callable> $handlers
     */
    public function __construct(private array $handlers)
    {
    }

    public function process(Input $input, Broker $next): ?Output
    {
        $handle = $this->handlers[$input::class];
        $handle($input);

        return null;
    }
}
