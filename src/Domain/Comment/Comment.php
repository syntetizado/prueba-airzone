<?php declare(strict_types=1);

namespace Airzone\Domain\Comment;

use Airzone\Domain\User\UserId;
use Airzone\Shared\Aggregate;
use DateTime;
use DateTimeImmutable;

final readonly class Comment implements Aggregate
{
    private function __construct(
        private CommentId $id,
        private Content $content,
        private Date $date,
        private UserId $userId
    )
    {
    }

    public static function fromArray(array $values): Comment
    {
        return new Comment(
            id: CommentId::fromInt($values['id']),
            content: Content::fromString($values['content']),
            date: Date::fromString($values['datetime']),
            userId: UserId::fromInt($values['user']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'user' => $this->userId->value(),
            'datetime' => $this->date->value(),
            'content' => $this->content->value()
        ];
    }
}
