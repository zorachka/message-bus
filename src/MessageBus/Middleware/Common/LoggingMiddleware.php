<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Common;

use Psr\Log\LoggerInterface;
use Zorachka\Framework\MessageBus\Middleware\Middleware;

final class LoggingMiddleware implements Middleware
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function process(object $input, callable $next): mixed
    {
        $this->logger->debug(\sprintf("Starting %s", $input::class));
        $returnValue = $next($input);
        $this->logger->debug(\sprintf("%s finished without errors", $input::class));

        return $returnValue;
    }
}
