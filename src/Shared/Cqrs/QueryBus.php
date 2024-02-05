<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

interface QueryBus
{
    public function handle(Query $query): QueryResponse;
    public function register(string $query, QueryHandler $handler): void;
}
