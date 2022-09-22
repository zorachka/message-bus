<?php

declare(strict_types=1);

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;
use Zorachka\Framework\MessageBus\Query\Middleware\QueryFetcherMiddleware;
use Zorachka\Framework\MessageBus\Query\QueryBus;
use Zorachka\Framework\MessageBus\Query\ZorachkaQueryBus;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query\AnotherFetcher;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query\AnotherQuery;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query\Fetcher;
use Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query\Query;

test('ZorachkaQueryBus should be instance of QueryBus', function () {
    $broker = $this->createStub(Broker::class);

    $bus = new ZorachkaQueryBus($broker);

    expect($bus)->toBeInstanceOf(QueryBus::class);
});

test('ZorachkaQueryBus should be able to fetch query', function () {
    $broker = SplQueueBrokerFactory::create([
        new QueryFetcherMiddleware([
            Query::class => new Fetcher(),
            AnotherQuery::class => new AnotherFetcher(),
        ])
    ]);

    $bus = new ZorachkaQueryBus($broker);

    $result = $bus->fetch(new Query());
    expect($result)->toBe('Result');

    $result = $bus->fetch(new AnotherQuery());
    expect($result)->toBe('Another Result');
});
