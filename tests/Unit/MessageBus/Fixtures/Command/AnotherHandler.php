<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Command;

final class AnotherHandler
{
    private bool $isHandled = false;

    public function __construct()
    {
    }

    public function __invoke(AnotherCommand $command): void
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
