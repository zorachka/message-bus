<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;

interface Middleware
{
    public function process(Input $input, Broker $next): ?Output;
}
