<?php

declare(strict_types=1);

use Zorachka\Framework\MessageBus\Command\Middleware\CommandHandlerMiddleware;
use Zorachka\Framework\MessageBus\Command\ZorachkaCommandBus;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Command\Command;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Command\Handler;

test('ZorachkaCommandBus should be able to handle command', function () {
    $broker = SplQueueBrokerFactory::create([
        new CommandHandlerMiddleware([
            Command::class => $handler = new Handler(),
        ])
    ]);

    $bus = new ZorachkaCommandBus($broker);
    $bus->handle(new Command());

    expect($handler->isHandled())->toBeTrue();
});
