<?php declare(strict_types=1);

namespace Airzone\Domain\User;

use Airzone\Shared\StringVo;

final readonly class UserName extends StringVo
{
    protected const REGEX = '/^[a-zA-Z]+(_[a-zA-Z0-9]+)*$/';
}
