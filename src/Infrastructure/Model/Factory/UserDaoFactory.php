<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model\Factory;

use Airzone\Infrastructure\Model\UserDao;
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
