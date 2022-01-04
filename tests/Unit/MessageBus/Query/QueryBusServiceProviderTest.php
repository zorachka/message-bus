<?php

declare(strict_types=1);

use Zorachka\Framework\MessageBus\Query\QueryBus;
use Zorachka\Framework\MessageBus\Query\QueryBusConfig;
use Zorachka\Framework\MessageBus\Query\QueryBusServiceProvider;

test('QueryBusServiceProvider', function () {
    expect(
        array_keys(QueryBusServiceProvider::getDefinitions())
    )->toMatchArray([
        QueryBus::class,
        QueryBusConfig::class,
    ]);
});
