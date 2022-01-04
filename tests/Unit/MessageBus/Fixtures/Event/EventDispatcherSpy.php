<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Event;

use Psr\EventDispatcher\EventDispatcherInterface;

final class EventDispatcherSpy implements EventDispatcherInterface
{
    private array $dispatchedEvents = [];

    /**
     * @inheritDoc
     */
    public function dispatch(object $event): object
    {
        $this->dispatchedEvents[] = $event;

        return $event;
    }

    /**
     * @return object[]
     */
    public function dispatchedEvents(): array
    {
        return $this->dispatchedEvents;
    }
}
