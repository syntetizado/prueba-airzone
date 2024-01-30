<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

/** @method JsonResponse execute() */
abstract class ApiController extends BaseController
{
    protected static function buildResponseFromArray(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }

    protected static function buildEmptyResponse(): JsonResponse
    {
        return new JsonResponse();
    }

    protected static function buildBadRequestResponse(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }

    protected static function buildConflictResponse(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_CONFLICT);
    }

    protected static function buildNotFoundResponse(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_NOT_FOUND);
    }

    use AuthorizesRequests, ValidatesRequests;
}
