<?php declare(strict_types=1);

namespace Airzone\Domain\Post;

use Airzone\Shared\StringVo;

final readonly class Title extends StringVo
{
    protected const MAX_CHARS = 50;
    protected const REGEX = '/^[a-zA-Z]+( [a-zA-Z0-9]+)*$/';
}
