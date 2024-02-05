<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Create;

use Airzone\Domain\Category\Category;
use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Exception\CategoryAlreadyExists;
use Airzone\Domain\Category\Exception\CategoryNotFound;
use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandHandler;
use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

final readonly class CreateCategory implements CommandHandler
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws InvalidString
     * @throws NegativeId
     * @throws CategoryNotFound
     * @throws CategoryAlreadyExists
     *
     * @var CreateCategoryCommand $command
     */
    public function handle(Command $command): void
    {
        $name = Name::fromString($command->name());
        $slug = Slug::fromString($command->slug());
        $parentCategoryId = $this->validatedParentId($command);

        $categoryExists = $this->categoryRepository->findByNameAndSlug($name, $slug);

        if (null !== $categoryExists) {
            throw CategoryAlreadyExists::ofNameAndSlug($name, $slug);
        }

        $category = Category::new(
            name: $name,
            slug: $slug,
            visible: $command->visible(),
            parentId: $parentCategoryId
        );

        $this->categoryRepository->create($category);
    }

    /**
     * @throws InvalidString
     * @throws NegativeId
     * @throws CategoryNotFound
     */
    private function validatedParentId(CreateCategoryCommand $command): ?CategoryId
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
