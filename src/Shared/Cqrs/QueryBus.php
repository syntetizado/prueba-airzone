<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

interface QueryBus
{
    public function handle(Query $query): QueryResponse;
}
