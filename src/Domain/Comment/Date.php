<?php declare(strict_types=1);

namespace Airzone\Domain\Comment;

use Carbon\CarbonImmutable;

final readonly class Date
{
    public function __construct(private CarbonImmutable $value)
    {
    }

    public static function fromString(string $value): Date
    {
        return new Date(new CarbonImmutable($value));
    }

    public function value(): string
    {
        return $this->value->format(DATE_W3C);
    }
}
