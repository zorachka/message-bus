<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\QueryBus\Datasets;

final class Fetcher
{
    public function __invoke(Query $query): mixed
    {
        return 'result';
    }
}
