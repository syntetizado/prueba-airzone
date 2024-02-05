<?php declare(strict_types=1);

namespace Airzone\Domain\Category\Exception;

use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Airzone\Shared\Exception\ApiException;

final class CategoryAlreadyExists extends ApiException
{
    public static function ofNameAndSlug(Name $name, Slug $slug): CategoryAlreadyExists
    {
        return new self(
            \sprintf("Category with name (%s) and slug (%s) already exists",
                $name->value(),
                $slug->value()
            ),
            409
        );
    }
}
