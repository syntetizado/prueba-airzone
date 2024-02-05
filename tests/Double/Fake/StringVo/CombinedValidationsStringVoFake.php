<?php declare(strict_types=1);

namespace Tests\Double\Fake\StringVo;

use Airzone\Shared\StringVo;

final readonly class CombinedValidationsStringVoFake extends StringVo
{
    protected const REGEX = '/^[A-Za-z ]*$/';
    protected const MAX_CHARS = 10;
}
