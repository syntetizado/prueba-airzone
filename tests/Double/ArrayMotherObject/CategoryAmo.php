<?php declare(strict_types=1);

namespace Tests\Double\ArrayMotherObject;

use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Tests\Double\ArrayMotherObject;

final class CategoryAmo extends ArrayMotherObject
{
    public static function create(
        int $parentId = null,
    ): array
    {
        $faker = \Faker\Factory::create();

        return [
            'parent_id' => $parentId,
            'name' => Name::generate()->value(),
            'slug' => Slug::generate()->value(),
            'visible' => $faker->boolean(),
        ];
    }

    public static function withNullParameter(string $parameter): array
    {
        $category = self::create();
        $category[$parameter] = null;

        return $category;
    }
}
