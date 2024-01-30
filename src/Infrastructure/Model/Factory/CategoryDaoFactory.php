<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model\Factory;

use Airzone\Infrastructure\Model\CategoryDao;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryDaoFactory extends Factory
{
    protected $model = CategoryDao::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->colorName(),
            'slug' => $faker->slug(),
            'visible' => true,
        ];
    }
}
