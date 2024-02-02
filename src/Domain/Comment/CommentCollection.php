<?php declare(strict_types=1);

namespace Airzone\Domain\Comment;

use Airzone\Shared\Collection;

final class CommentCollection extends Collection
{
    protected const TYPE = Comment::class;
}
