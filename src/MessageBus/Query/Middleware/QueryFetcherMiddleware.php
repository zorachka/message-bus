<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query\Middleware;

use Zorachka\Framework\MessageBus\Middleware\Middleware;

final class QueryFetcherMiddleware implements Middleware
{
    /**
     * @param array<class-string, callable> $fetchers
     */
    public function __construct(private array $fetchers)
    {
    }

    public function process(object $input, callable $next): mixed
    {
        /** @var callable $fetch */
        $fetch = $this->fetchers[$input::class];

        return $fetch($input);
    }
}
