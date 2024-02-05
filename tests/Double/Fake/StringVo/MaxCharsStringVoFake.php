<?php declare(strict_types=1);

namespace Tests\Double\Fake\StringVo;

use Airzone\Shared\StringVo;

final readonly class MaxCharsStringVoFake extends StringVo
{
    protected const MAX_CHARS = 10;
    protected const REGEX = '/^[A-Za-z ]*$/';
}
