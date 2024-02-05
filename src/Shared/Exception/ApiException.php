<?php declare(strict_types=1);

namespace Airzone\Shared\Exception;

use Illuminate\Http\JsonResponse;
use Throwable;

abstract class ApiException extends \Exception
{
    private const DEFAULT_CODE = 500;

    protected function __construct(string $message = "", int $code = self::DEFAULT_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return new JsonResponse(['Error' => $this->message], $this->code);
    }
}
