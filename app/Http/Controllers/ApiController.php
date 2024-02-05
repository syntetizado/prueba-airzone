<?php

namespace App\Http\Controllers;

use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandBus;
use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryBus;
use Airzone\Shared\Cqrs\QueryResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

/** @method JsonResponse execute() */
abstract class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /** Builds a JsonResponse from an array input */
    protected static function buildResponseFromArray(array $data): JsonResponse
    {
        return new JsonResponse($data);
    }

    /** Builds an empty JsonResponse */
    protected static function buildEmptyResponse(): JsonResponse
    {
        return new JsonResponse();
    }

    /** Builds an empty JsonResponse that returns Bad Request [400] */
    protected static function buildBadRequestResponse(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }

    protected static function handleCommand(Command $command): void
    {
        /** @var CommandBus $bus */
        $bus = \app(CommandBus::class);

        $bus->handle($command);
    }

    protected static function handleQuery(Query $query): QueryResponse
    {
        /** @var QueryBus $bus */
        $bus = \app(QueryBus::class);

        return $bus->handle($query);
    }
}
