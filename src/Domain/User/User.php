<?php declare(strict_types=1);

namespace Airzone\Domain\User;

use Airzone\Shared\Aggregate;

final readonly class User implements Aggregate
{
    public function __construct(
        private UserId $id,
        private UserName $userName,
        private FullName $fullName
    )
    {
    }

    public static function fromArray(array $values): User
    {
        return new User(
            id: UserId::fromInt($values['id']),
            userName: UserName::fromString($values['username']),
            fullName: FullName::fromString($values['full_name']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'username' => $this->userName->value(),
            'full_name' => $this->fullName->value()
        ];
    }
}
