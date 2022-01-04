<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Event;

final class EventBusConfig
{
    private array $middlewares;

    private function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public static function withDefaults(
        array $middlewares = [],
    ): self {
        return new self($middlewares);
    }

    /**
     * @param class-string $middlewareClassName
     * @return EventBusConfig
     */
    public function withMiddleware(string $middlewareClassName): self
    {
        $new = clone $this;
        $new->middlewares[] = $middlewareClassName;

        return $new;
    }

    /**
     * @return array
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }
}
