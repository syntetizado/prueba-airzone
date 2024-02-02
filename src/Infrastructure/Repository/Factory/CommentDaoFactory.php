<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Infrastructure\Repository\Model\CommentDao;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentDaoFactory extends Factory
{
    protected $model = CommentDao::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'datetime' => (new DateTime()),
            'content' => $faker->text(20),
            'user' => 1,
        ];
    }
}
