<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Infrastructure\Repository\Model\UserDao;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDaoFactory extends Factory
{
    protected $model = UserDao::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'username' => $faker->userName(),
            'full_name' => $faker->firstName(),
        ];
    }
}
