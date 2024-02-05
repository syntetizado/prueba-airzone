<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Post;

use Airzone\Application\Query\Post\Read\ReadPostQuery;
use Airzone\Domain\Post\PostRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadPostController extends ApiController
{
    public function execute(int $id, PostRepository $postRepository): JsonResponse
    {
        $response = self::handleQuery(
            new ReadPostQuery($id)
        );

        return self::buildResponseFromArray($response->toArray());
    }
}
