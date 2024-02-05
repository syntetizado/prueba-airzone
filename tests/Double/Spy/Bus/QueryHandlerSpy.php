<?php declare(strict_types=1);

namespace Tests\Double\Spy\Bus;

use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryHandler;
use Airzone\Shared\Cqrs\QueryResponse;
use Tests\Double\Dummy\Bus\FooQueryResponse;

final class QueryHandlerSpy implements QueryHandler
{
    private bool $hasHandledQuery = false;

    public function handle(Query $query): QueryResponse
    {
        $this->hasHandledQuery = true;
        return new FooQueryResponse;
    }

    public function hasHandledQuery(): bool
    {
        return $this->hasHandledQuery;
    }
}
