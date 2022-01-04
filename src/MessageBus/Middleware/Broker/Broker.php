<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Broker;

interface Broker
{
    public function __invoke(object $input): mixed;
}
