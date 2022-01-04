<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query;

final class QueryBusConfig
{
    private array $fetchersMap;
    private array $middlewares;

    private function __construct(array $fetchersMap, array $middlewares)
    {
        $this->fetchersMap = $fetchersMap;
        $this->middlewares = $middlewares;
    }

    public static function withDefaults(
        array $fetchersMap = [],
        array $middlewares = [],
    ): self {
        return new self($fetchersMap, $middlewares);
    }

    /**
     * @param class-string $queryClassName
     * @param class-string $fetcherClassName
     * @return QueryBusConfig
     */
    public function withFetcherFor(string $queryClassName, string $fetcherClassName): self
    {
        $new = clone $this;
        $new->fetchersMap[$queryClassName] = $fetcherClassName;

        return $new;
    }

    /**
     * @return array
     */
    public function fetchersMap(): array
    {
        return $this->fetchersMap;
    }

    /**
     * @param class-string $middlewareClassName
     * @return QueryBusConfig
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
