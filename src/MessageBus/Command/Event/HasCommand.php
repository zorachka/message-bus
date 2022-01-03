<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Event;

trait HasCommand
{
    private string $commandName;

    /**
     * @return string
     */
    public function commandName(): string
    {
        return $this->commandName;
    }
}
