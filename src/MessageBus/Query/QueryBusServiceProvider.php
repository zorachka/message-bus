<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query;

use Psr\Container\ContainerInterface;
use Zorachka\Framework\Container\ServiceProvider;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;
use Zorachka\Framework\MessageBus\Query\Middleware\QueryFetcherMiddleware;

final class QueryBusServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            QueryBus::class => static function (ContainerInterface $container) {
                /** @var QueryBusConfig $config */
                $config = $container->get(QueryBusConfig::class);
                $fetchers = \array_map(function (string $fetcherClassName) use ($container) {
                    return $container->get($fetcherClassName);
                }, $config->fetchersMap());

                $middlewares = \array_map(function ($middlewareClassName) use ($container) {
                    return $container->get($middlewareClassName);
                }, $config->middlewares());

                $middlewares[] = new QueryFetcherMiddleware($fetchers);
                $broker = SplQueueBrokerFactory::create($middlewares);

                return new ZorachkaQueryBus($broker);
            },
            QueryBusConfig::class => static fn() => QueryBusConfig::withDefaults(),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getExtensions(): array
    {
        return [];
    }
}
