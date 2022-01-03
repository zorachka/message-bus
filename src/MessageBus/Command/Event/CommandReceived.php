<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Event;

final class CommandReceived
{
    use HasCommand;

    private function __construct(string $commandName)
    {
        $this->commandName = $commandName;
    }

    public static function withCommand(object $command): self
    {
        return new self($command::class);
    }
}
