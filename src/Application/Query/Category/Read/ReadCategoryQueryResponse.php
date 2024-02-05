<?php declare(strict_types=1);

namespace Airzone\Application\Query\Category\Read;

use Airzone\Domain\Category\Category;
use Airzone\Shared\Cqrs\QueryResponse;

final readonly class ReadCategoryQueryResponse extends QueryResponse
{
    public function __construct(private Category $category)
    {
    }

    function toArray(): array
    {
        return [
            'parent_id' => $this->category->parentId()?->value(),
            'name' => $this->category->name()->value(),
            'slug' => $this->category->slug()->value(),
            'visible' => $this->category->visible()
        ];
    }
}
