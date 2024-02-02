<?php declare(strict_types=1);

namespace Airzone\Domain\Category;

use Airzone\Shared\StringVo;

final readonly class Name extends StringVo
{
    protected const REGEX = '/^[a-zA-Z]+( [a-zA-Z0-9]+)*$/';
}
