<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Command;

use Psr\Container\ContainerInterface;
use Zorachka\Framework\Container\ServiceProvider;
use Zorachka\Framework\MessageBus\Command\Middleware\CommandHandlerMiddleware;
use Zorachka\Framework\MessageBus\Middleware\Broker\SplQueueBrokerFactory;

final class CommandBusServiceProvider implements ServiceProvider
{
    /**
     * @inheritDoc
     */
    public static function getDefinitions(): array
    {
        return [
            CommandBus::class => static function (ContainerInterface $container) {
                /** @var CommandBusConfig $config */
                $config = $container->get(CommandBusConfig::class);

                $handlers = \array_map(function ($handlerClassName) use ($container) {
                    return $container->get($handlerClassName);
                }, $config->handlersMap());
                $middlewares = \array_map(function ($middlewareClassName) use ($container) {
                    return $container->get($middlewareClassName);
                }, $config->middlewares());

                $middlewares[] = new CommandHandlerMiddleware($handlers);
                $broker = SplQueueBrokerFactory::create($middlewares);

                return new ZorachkaCommandBus($broker);
            },
            CommandBusConfig::class => static fn() => CommandBusConfig::withDefaults(),
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
