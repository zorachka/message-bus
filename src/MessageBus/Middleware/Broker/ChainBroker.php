<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Broker;

final class ChainBroker implements Broker
{
    /** @var callable[] */
    private array $handlers = [];

    public function add(callable $handler): self
    {
        $self = clone $this;
        $self->handlers[] = $handler;
        return $self;
    }

    public function apply(int $payload): int
    {
        foreach ($this->handlers as $handler) {
            $payload = $handler($payload);
        }

        return $payload;
    }

    public function __invoke(object $input): mixed
    {
        foreach ($this->handlers as $handler) {
            $payload = $handler($input);
        }

        return $payload;
    }
}
