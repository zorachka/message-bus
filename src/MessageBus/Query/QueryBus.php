<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query;

interface QueryBus
{
    public function fetch(object $query): mixed;
}
