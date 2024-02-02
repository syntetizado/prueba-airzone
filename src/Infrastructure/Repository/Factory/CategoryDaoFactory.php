<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryDaoFactory extends Factory
{
    protected $model = CategoryDao::class;

    public function definition(): array
    {
        return [
            'name' => Name::generate()->value(),
            'slug' => Slug::generate()->value(),
            'visible' => true,
        ];
    }
}
