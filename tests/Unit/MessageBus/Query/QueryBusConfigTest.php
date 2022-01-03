<?php

declare(strict_types=1);

use Zorachka\Framework\QueryBus\QueryBusConfig;
use Zorachka\Framework\Tests\Unit\QueryBus\Datasets\Fetcher;
use Zorachka\Framework\Tests\Unit\QueryBus\Datasets\Query;

test('QueryBusConfig should be able to be created with defaults', function () {
    $config = QueryBusConfig::withDefaults();

    expect($config->fetchersMap())->toBeArray();
});

test('QueryBusConfig should be able to add new fetcher for query', function () {
    $config = QueryBusConfig::withDefaults();
    $newConfig = $config->withFetcherFor(Query::class, Fetcher::class);

    expect($newConfig->fetchersMap())->toMatchArray([Query::class => Fetcher::class]);
});
