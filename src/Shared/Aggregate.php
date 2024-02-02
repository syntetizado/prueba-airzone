<?php declare(strict_types=1);

namespace Airzone\Shared;

interface Aggregate
{
    public function toArray(): array;
    public static function fromArray(array $values): Aggregate;
}
