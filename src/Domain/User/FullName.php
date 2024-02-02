<?php declare(strict_types=1);

namespace Airzone\Domain\User;

use Airzone\Shared\StringVo;

final readonly class FullName extends StringVo
{
    protected const REGEX = '/^[a-zA-Z]+( [a-zA-Z0-9]+)*$/';
}
