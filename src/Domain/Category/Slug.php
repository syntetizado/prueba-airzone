<?php declare(strict_types=1);

namespace Airzone\Domain\Category;

use Airzone\Shared\StringVo;

final readonly class Slug extends StringVo
{
    protected const REGEX = '/^[a-z0-9]+(-[a-z0-9]+)*$/';
}
