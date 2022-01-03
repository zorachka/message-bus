<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Broker;

use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Output;

interface Broker
{
    public function __invoke(Input $input): Output;
}
