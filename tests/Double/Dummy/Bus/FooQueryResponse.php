<?php declare(strict_types=1);

namespace Tests\Double\Dummy\Bus;

use Airzone\Shared\Cqrs\QueryResponse;

final readonly class FooQueryResponse extends QueryResponse
{
    function toArray(): array
    {
        return [];
    }
}
