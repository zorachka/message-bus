<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware;

/**
 * @template T
 */
interface Middleware
{
    /**
     * @param T $input
     * @param callable $next
     * @return mixed
     */
    public function process(object $input, callable $next): mixed;
}
