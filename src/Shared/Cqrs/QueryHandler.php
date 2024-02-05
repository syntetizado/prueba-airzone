<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

interface QueryHandler
{
    public function handle(Query $query): QueryResponse;
}
