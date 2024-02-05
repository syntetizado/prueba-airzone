<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Delete;

use Airzone\Domain\Category\CategoryId;
use Airzone\Domain\Category\CategoryRepository;
use Airzone\Domain\Category\Exception\CategoryNotFound;
use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandHandler;
use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

final readonly class DeleteCategory implements CommandHandler
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws CategoryNotFound
     * @throws InvalidString
     * @throws NegativeId
     *
     * @param DeleteCategoryCommand $command
     */
    public function handle(Command $command): void
    {
        $categoryId = CategoryId::fromInt($command->id());

        $category = $this->categoryRepository->findById($categoryId);

        if (null === $category) {
            throw CategoryNotFound::ofId($categoryId);
        }

        $this->categoryRepository->delete($categoryId);
    }
}
