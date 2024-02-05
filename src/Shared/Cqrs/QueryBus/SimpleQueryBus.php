<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs\QueryBus;

use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryBus;
use Airzone\Shared\Cqrs\QueryHandler;
use Airzone\Shared\Cqrs\QueryResponse;

final class SimpleQueryBus implements QueryBus
{
    private array $queryHandlers;

    public function register(string $query, QueryHandler $handler): void
    {
        $this->queryHandlers[$query] = $handler;
    }

    public function handle(Query $query): QueryResponse
    {
        $queryName = $query::class;

        if (!isset($this->queryHandlers[$queryName])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'No valid handler found for command "%s"',
                    $queryName
                )
            );
        }

        /** @var QueryHandler $handler */
        $handler = $this->queryHandlers[$queryName];
        return $handler->handle($query);
    }
}
