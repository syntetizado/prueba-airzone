<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository;

use Airzone\Domain\Post\Post;
use Airzone\Domain\Post\PostId;
use Airzone\Domain\Post\PostRepository;
use Airzone\Infrastructure\Repository\Model\CommentDao;
use Airzone\Infrastructure\Repository\Model\PostDao;
use DateTime;

final class EloquentPostRepository implements PostRepository
{
    public function findById(PostId $postId): ?Post
    {
        /**
         * @var PostDao $postDao
         *
         * @uses PostDao::owner
         * @uses PostDao::writers
         * @uses PostDao::comments
         */
        $postDao = PostDao::query()
            ->with(['owner', 'writers', 'comments'])
            ->find($postId->value())
        ;

        if (null === $postDao) {
            return null;
        }

        return Post::fromArray($postDao->toArray());
    }
}
