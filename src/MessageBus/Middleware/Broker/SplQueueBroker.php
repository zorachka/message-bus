<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Broker;

use SplQueue;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

final class SplQueueBroker implements Broker
{
    public function __construct(
        private SplQueue $queue,
    ) {
    }

    public function __invoke(Input $input): Output
    {
        /** @var Middleware $middleware */
        $middleware = $this->queue->dequeue();

        return $middleware->process($input, $this);
    }
}
