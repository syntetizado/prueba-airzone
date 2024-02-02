<?php declare(strict_types=1);

namespace Airzone\Domain\Post;

interface PostRepository
{
    public function findById(PostId $postId): ?Post;
}
