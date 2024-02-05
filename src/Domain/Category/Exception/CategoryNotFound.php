<?php declare(strict_types=1);

namespace Airzone\Domain\Category\Exception;

use Airzone\Domain\Category\CategoryId;
use Airzone\Shared\Exception\ApiException;

final class CategoryNotFound extends ApiException
{
    public static function ofId(CategoryId $categoryId): CategoryNotFound
    {
        return new self(\sprintf("Category with id (%s) not found", $categoryId->value()), 404);
    }
    public static function ofParentId(CategoryId $parentCategoryId): CategoryNotFound
    {
        return new self(\sprintf("Parent Category with id (%s) not found", $parentCategoryId->value()), 409);
    }
}
