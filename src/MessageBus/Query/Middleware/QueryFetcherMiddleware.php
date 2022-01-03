<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query\Middleware;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

final class QueryFetcherMiddleware implements Middleware
{
    /**
     * @param array<class-string, callable> $fetchers
     */
    public function __construct(private array $fetchers)
    {
    }

    public function process(Input $input, Broker $next): Output
    {
        /** @var callable $fetch */
        $fetch = $this->fetchers[$input::class];

        return $fetch($input);
    }
}
