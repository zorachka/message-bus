<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Event;

final class Listener
{
    private bool $isHandled = false;

    public function __construct()
    {
    }

    public function __invoke(Event $event): void
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
