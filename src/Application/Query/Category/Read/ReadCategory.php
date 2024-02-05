<?php declare(strict_types=1);

namespace Airzone\Application\Query\Category\Read;

use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Exception\CategoryNotFound;
use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryHandler;
use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

final readonly class ReadCategory implements QueryHandler
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws CategoryNotFound
     * @throws InvalidString
     * @throws NegativeId
     *
     * @param ReadCategoryQuery $query
     */
    public function handle(Query $query): ReadCategoryQueryResponse
    {
        $categoryId = CategoryId::fromInt($query->id());

        $category = $this->categoryRepository->findById($categoryId);

        if (null === $category) {
            throw CategoryNotFound::ofId($categoryId);
        }

        return new ReadCategoryQueryResponse($category);
    }
}
