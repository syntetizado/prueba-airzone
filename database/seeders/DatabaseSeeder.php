<?php declare(strict_types=1);

namespace Database\Seeders;

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Factory\CommentDaoFactory;
use Airzone\Infrastructure\Repository\Factory\PostDaoFactory;
use Airzone\Infrastructure\Repository\Factory\UserDaoFactory;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(
        UserDaoFactory $userDaoFactory,
        PostDaoFactory $postDaoFactory,
        CommentDaoFactory $commentDaoFactory,
        CategoryDaoFactory $categoryDaoFactory,
    ): void
    {
        $userDaoFactory->createMany(5);
        $postDaoFactory->createMany(5);
        $commentDaoFactory->createMany(5);
        $categoryDaoFactory->createMany(5);
    }
}
