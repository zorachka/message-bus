<?php

declare(strict_types=1);

use Zorachka\Framework\MessageBus\Event\Middleware\EventDispatcherMiddleware;
use Zorachka\Framework\MessageBus\Event\ZorachkaEventBus;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Event\Event;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Event\EventDispatcherSpy;

test('ZorachkaEventBus should be able to dispatch events', function () {
    $broker = SplQueueBrokerFactory::create([
        new EventDispatcherMiddleware(
            $eventDispatcherSpy = new EventDispatcherSpy()
        )
    ]);

    $bus = new ZorachkaEventBus($broker);
    $bus->dispatch([
        $event = new Event()
    ]);

    expect($eventDispatcherSpy->dispatchedEvents())->toMatchArray([
        $event
    ]);
});
