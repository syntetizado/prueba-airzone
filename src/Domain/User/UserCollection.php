<?php declare(strict_types=1);

namespace Airzone\Domain\User;

use Airzone\Shared\Collection;

final class UserCollection extends Collection
{
    protected const TYPE = User::class;
}
