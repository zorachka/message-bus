<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Middleware;

use Zorachka\Framework\MessageBus\Middleware\Middleware;

final class CommandHandlerMiddleware implements Middleware
{
    /**
     * @param array<class-string, callable> $handlers
     */
    public function __construct(private array $handlers)
    {
    }

    public function process(object $input, callable $next): mixed
    {
        $handle = $this->handlers[$input::class];
        $handle($input);

        return null;
    }
}
