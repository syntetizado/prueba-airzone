<?php declare(strict_types=1);

namespace Airzone\Application\Query\Category\Read;

use Airzone\Shared\Cqrs\Query;

final readonly class ReadCategoryQuery extends Query
{
    public function __construct(private int $id)
    {
    }

    public function id(): int
    {
        return $this->id;
    }
}
