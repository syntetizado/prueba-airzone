<?php declare(strict_types=1);

namespace Airzone\Domain\Post\Exception;

use Airzone\Domain\Post\PostId;
use Airzone\Shared\Exception\ApiException;

final class PostNotFound extends ApiException
{
    public static function ofId(PostId $postId): PostNotFound
    {
        return new self(\sprintf("Post with id (%s) not found", $postId->value()), 404);
    }
}
