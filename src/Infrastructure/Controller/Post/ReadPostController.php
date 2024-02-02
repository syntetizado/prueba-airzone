<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Controller\Post;

use Airzone\Infrastructure\Repository\Model\CommentDao;
use Airzone\Infrastructure\Repository\Model\PostDao;
use App\Http\Controllers\ApiController;
use DateTime;
use Illuminate\Http\JsonResponse;

final class ReadPostController extends ApiController
{
    public function execute(int $id): JsonResponse
    {
        /** @var PostDao $postDao */
        $postDao = PostDao::find($id);

        if (!$postDao) {
            return self::buildNotFoundResponse();
        }

        /**
         * @uses PostDao::owner
         * @uses PostDao::writers
         * @uses PostDao::comments
         */
        return self::buildResponseFromArray([
            'body' => [
                'post' => [
                    'id' => $postDao->id,
                    'title' => $postDao->title,
                    'short_content' => $postDao->short_content,
                    'owner' => $postDao->owner->toArray(),
                    'users' => $postDao->writers->toArray(),
                    'comments' => $postDao->comments->map(function (CommentDao $commentDao) {
                        return [
                            'id' => $commentDao->id,
                            'user' => $commentDao->user,
                            'datetime' => $commentDao->datetime->format(DateTime::W3C),
                            'content' => $commentDao->content
                        ];
                    })
                ]
            ]
        ]);
    }
}
