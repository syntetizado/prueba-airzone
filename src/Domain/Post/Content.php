<?php declare(strict_types=1);

namespace Airzone\Domain\Post;

use Airzone\Shared\StringVo;

final readonly class Content extends StringVo
{
    protected const MAX_CHARS = 2000;
}
