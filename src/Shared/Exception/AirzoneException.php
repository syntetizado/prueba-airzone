<?php declare(strict_types=1);

namespace Airzone\Shared\Exception;

use Throwable;

abstract class AirzoneException extends \Exception
{
    protected function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
