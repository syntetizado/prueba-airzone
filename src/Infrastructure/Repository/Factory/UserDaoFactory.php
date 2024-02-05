<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Domain\User\FullName;
use Airzone\Domain\User\UserName;
use Airzone\Infrastructure\Repository\Model\UserDao;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDaoFactory extends Factory
{
    protected $model = UserDao::class;

    public function definition(): array
    {
        return [
            'username' => UserName::generate()->value(),
            'full_name' => FullName::generate()->value(),
        ];
    }
}
