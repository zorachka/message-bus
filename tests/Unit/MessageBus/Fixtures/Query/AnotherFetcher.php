<?php

declare(strict_types=1);

namespace Zorachka\Framework\Tests\Unit\MessageBus\Fixtures\Query;

final class AnotherFetcher
{
    public function __invoke(Query $query): string
    {
        return 'Another Result';
    }
}
