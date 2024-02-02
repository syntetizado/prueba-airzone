<?php declare(strict_types=1);

namespace Tests\Double\ArrayMotherObject;

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
            'name' => $faker->regexify('/^[a-zA-Z]+( [a-zA-Z0-9]+)*$/'),
            'slug' => $faker->slug(),
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
