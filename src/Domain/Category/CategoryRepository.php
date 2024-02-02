<?php declare(strict_types=1);

namespace Airzone\Domain\Category;

use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

interface CategoryRepository
{
    /**
     * @throws InvalidString
     * @throws NegativeId
     */
    public function findById(CategoryId $id): ?Category;

    /**
     * @throws InvalidString
     * @throws NegativeId
     */
    public function findByNameAndSlug(Name $name, Slug $slug): ?Category;

    public function delete(CategoryId $id): void;

    public function save(Category $category): void;

    public function create(Category $category): void;
}
