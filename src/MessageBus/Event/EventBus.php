<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event;

interface EventBus
{
    /**
     * @param object[] $events
     * @return void
     */
    public function dispatch(array $events): void;
}
