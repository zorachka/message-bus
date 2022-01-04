<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command;

interface CommandBus
{
    public function handle(object $command): void;
}
