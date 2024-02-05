<?php declare(strict_types=1);

namespace Airzone\Shared\Exception;

final class InvalidCollection extends ApiException
{
    public static function byItem(object $item): InvalidCollection
    {
        return new self(\sprintf("One item (%s) of the collection is not valid", $item::class));
    }
}
