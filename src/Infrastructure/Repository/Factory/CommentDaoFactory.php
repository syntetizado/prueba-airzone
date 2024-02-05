<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Factory;

use Airzone\Domain\Comment\Content;
use Airzone\Infrastructure\Repository\Model\CommentDao;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentDaoFactory extends Factory
{
    protected $model = CommentDao::class;

    public function definition(): array
    {
        return [
            'datetime' => (new DateTime()),
            'content' => Content::generate()->value(),
            'user' => 1,
        ];
    }
}
