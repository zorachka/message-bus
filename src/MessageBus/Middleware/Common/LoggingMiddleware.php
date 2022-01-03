<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Common;

use Psr\Log\LoggerInterface;
use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

final class LoggingMiddleware implements Middleware
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function process(Input $input, Broker $next): Output
    {
        $this->logger->debug(\sprintf("Starting %s", $input::class));
        $returnValue = $next($input);
        $this->logger->debug(\sprintf("%s finished without errors", $input::class));

        return $returnValue;
    }
}
