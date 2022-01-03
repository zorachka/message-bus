<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command\Event;

use Exception;

final class CommandFailed
{
    use HasCommand;

    private ?Exception $exception;

    private function __construct(string $commandName, ?Exception $exception)
    {
        $this->commandName = $commandName;
        $this->exception = $exception;
    }

    public static function with(object $command, Exception $exception): self
    {
        return new self($command::class, $exception);
    }

    /**
     * @return ?Exception
     */
    public function exception(): ?Exception
    {
        return $this->exception;
    }
}
