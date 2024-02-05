<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

abstract readonly class QueryResponse
{
    abstract function toArray(): array;
}
