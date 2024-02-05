<?php declare(strict_types=1);

namespace Tests\Double\MotherObject;

use Airzone\Domain\Category\Category;
use Tests\Double\ArrayMotherObject\CategoryAmo;
use Tests\Double\MotherObject;

final class CategoryMo extends MotherObject
{
    public static function create(int $parentId = null): Category
    {
        $values = CategoryAmo::create($parentId);

        return Category::fromValues($values);
    }

    public static function createWithValues(array $values): Category
    {
        $amoValues = CategoryAmo::create();

        return Category::fromValues([
            'id' => $values['id'] ?? $amoValues['id'],
            'parent_id' => $values['parent_id'] ?? $amoValues['parent_id'],
            'name' => $values['name'] ?? $amoValues['name'],
            'slug' => $values['slug'] ?? $amoValues['slug'],
            'visible' => $values['visible'] ?? $amoValues['visible'],
        ]);
    }
}
