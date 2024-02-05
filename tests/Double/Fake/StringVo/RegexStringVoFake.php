<?php declare(strict_types=1);

namespace Tests\Double\Fake\StringVo;

use Airzone\Shared\StringVo;

final readonly class RegexStringVoFake extends StringVo
{
    protected const REGEX = '/^[A-Za-z ]*$/';
}
