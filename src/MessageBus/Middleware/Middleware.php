<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware;

interface Middleware
{
    public function process(object $input, callable $next): mixed;
}
