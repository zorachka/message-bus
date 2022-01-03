<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;

final class ZorachkaCommandBus implements CommandBus
{
    public function __construct(private Broker $broker)
    {
    }

    public function handle(Command $command): void
    {
        $broker = $this->broker;
        $broker($command);
    }
}
