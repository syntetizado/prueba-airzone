<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Post;

use Airzone\Domain\Post\PostId;
use Airzone\Domain\Post\PostRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ReadPostController extends ApiController
{
    public function execute(int $id, PostRepository $postRepository): JsonResponse
    {
        $post = $postRepository->findById(PostId::fromInt($id));

        if (null === $post) {
            return self::buildNotFoundResponse();
        }

        return self::buildResponseFromArray([
            'body' => [
                'post' => $post->toArray()
            ]
        ]);
    }
}
