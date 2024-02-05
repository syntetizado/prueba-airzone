<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Update;

use Airzone\Application\Command\Category\Create\CreateCategoryCommand;
use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Exception\CategoryNotFound;
use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandHandler;
use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

final readonly class UpdateCategory implements CommandHandler
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws CategoryNotFound
     * @throws InvalidString
     * @throws NegativeId
     *
     * @var UpdateCategoryCommand $command
     */
    public function handle(Command $command): void
    {
        $categoryId = CategoryId::fromInt($command->id());
        $category = $this->categoryRepository->findById($categoryId);

        if (null === $category) {
            throw CategoryNotFound::ofId($categoryId);
        }

        $parentCategoryId = $this->validatedParentId($command);

        $valuesToUpdate = [
            'parent_id' => $parentCategoryId,
            'name' => $command->name(),
            'slug' => $command->slug(),
            'visible' => $command->visible(),
        ];

        $category = $category->withUpdatedValues($valuesToUpdate);

        $this->categoryRepository->save($category);
    }

    /**
     * @throws InvalidString
     * @throws NegativeId
     * @throws CategoryNotFound
     */
    private function validatedParentId(UpdateCategoryCommand $command): ?CategoryId
    {
        if (null === $command->parentId()) {
            return null;
        }

        $parentCategoryId = CategoryId::fromInt($command->parentId());
        $parentCategory = $this->categoryRepository->findById($parentCategoryId);

        if (null === $parentCategory) {
            throw CategoryNotFound::ofParentId($parentCategoryId);
        }

        return $parentCategoryId;
    }
}
