<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event;

use SplQueue;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Zorachka\Framework\Container\ServiceProvider;
use Zorachka\Framework\MessageBus\Command\Middleware\CommandHandlerMiddleware;
use Zorachka\Framework\MessageBus\Event\Middleware\EventDispatcherMiddleware;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBroker;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;

final class EventBusServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            EventBus::class => static function (ContainerInterface $container) {
                /** @var EventBusConfig $config */
                $config = $container->get(EventBusConfig::class);

                $middlewares = \array_map(function ($middlewareClassName) use ($container) {
                    return $container->get($middlewareClassName);
                }, $config->middlewares());

                /** @var EventDispatcherInterface $eventDispatcher */
                $eventDispatcher = $container->get(EventDispatcherInterface::class);
                $middlewares[] = new EventDispatcherMiddleware($eventDispatcher);
                $broker = SplQueueBrokerFactory::create($middlewares);

                return new ZorachkaEventBus($broker);
            },
            EventBusConfig::class => static fn() => EventBusConfig::withDefaults(),
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
