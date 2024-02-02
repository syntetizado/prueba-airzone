<?php declare(strict_types=1);

namespace Airzone\Domain\Post;

use Airzone\Domain\Comment\CommentCollection;
use Airzone\Domain\User\User;
use Airzone\Domain\User\UserCollection;
use Airzone\Shared\Aggregate;

final readonly class Post implements Aggregate
{
    private function __construct(
        private PostId $id,
        private Title $title,
        private ShortContent $shortContent,
        private User $owner,
        private UserCollection $writers,
        private CommentCollection $comments,
    )
    {
    }

    public static function fromArray(array $values): Post
    {
        return new Post(
            id: PostId::fromInt($values['id']),
            title: Title::fromString($values['title']),
            shortContent: ShortContent::fromString($values['short_content']),
            owner: User::fromArray($values['owner']),
            writers: UserCollection::fromArray($values['writers']),
            comments: CommentCollection::fromArray($values['comments']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title->value(),
            'short_content' => $this->shortContent->value(),
            'owner' => $this->owner->toArray(),
            'users' => $this->writers->toArray(),
            'comments' => $this->comments->toArray()
        ];
    }
}
