<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query;

final class Fetcher
{
    public function __invoke(Query $query): string
    {
        return 'Result';
    }
}
