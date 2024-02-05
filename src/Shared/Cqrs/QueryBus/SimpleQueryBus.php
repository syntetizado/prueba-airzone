<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs\QueryBus;

use Airzone\Application\Query\Category\Read\ReadCategory;
use Airzone\Application\Query\Category\Read\ReadCategoryQuery;
use Airzone\Application\Query\Post\Read\ReadPost;
use Airzone\Application\Query\Post\Read\ReadPostQuery;
use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryBus;
use Airzone\Shared\Cqrs\QueryHandler;
use Airzone\Shared\Cqrs\QueryResponse;

final class SimpleQueryBus implements QueryBus
{
    private array $queryHandlers;

    public function __construct()
    {
        $this->queryHandlers = [
            ReadCategoryQuery::class => \app(ReadCategory::class),
            ReadPostQuery::class => \app(ReadPost::class),
        ];
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
