<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Infrastructure\Repository\Model\PostDao;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostDaoFactory extends Factory
{
    protected $model = PostDao::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'updated' => new DateTime(),
            'added' => new DateTime(),
            'title' => $faker->title(),
            'slug' => $faker->slug(),
            'marks' => null,
            'picture' => 'http://placekitten.com/200/300',
            'short_content' => $faker->text(20),
            'content' => $faker->text(20),
            'comment' => true,
            'pending' => true,
            'public' => true,
            'active' => true,
            'user' => 1,
        ];
    }
}
