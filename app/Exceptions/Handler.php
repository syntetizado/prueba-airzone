<?php

namespace App\Exceptions;

use Airzone\Shared\Exception\ApiException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ApiException) {
            return $e->render();
        }

        return parent::render($request, $e);
    }
}
