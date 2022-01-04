<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Command;

final class Handler
{
    private bool $isHandled = false;

    public function __construct()
    {
    }

    public function __invoke(Command $command): void
    {
        $this->isHandled = true;
    }

    /**
     * @return bool
     */
    public function isHandled(): bool
    {
        return $this->isHandled;
    }
}
