<?php declare(strict_types=1);

namespace Airzone\Shared\Exception;

use Airzone\Shared\Id;

final class NegativeId extends ApiException
{
    public static function byId(Id $id): NegativeId
    {
        return new self(
            message: \sprintf("Id (%s) must be positive", $id->value()),
            code: 400
        );
    }
}
