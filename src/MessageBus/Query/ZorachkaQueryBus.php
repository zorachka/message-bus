<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Query;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;

final class ZorachkaQueryBus implements QueryBus
{
    public function __construct(private Broker $broker)
    {
    }

    public function fetch(Query $query): Result
    {
        $fetch = $this->broker;
        /** @var Result $result */
        $result = $fetch($query);

        return $result;
    }
}
