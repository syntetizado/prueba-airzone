<?php declare(strict_types=1);

namespace Airzone\Application\Query\Post\Read;

use Airzone\Application\Query\Category\Read\ReadCategoryQuery;
use Airzone\Domain\Post\Exception\PostNotFound;
use Airzone\Domain\Post\PostId;
use Airzone\Domain\Post\PostRepository;
use Airzone\Shared\Cqrs\Query;
use Airzone\Shared\Cqrs\QueryHandler;
use Airzone\Shared\Exception\NegativeId;

final readonly class ReadPost implements QueryHandler
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    /**
     * @throws NegativeId
     * @throws PostNotFound
     *
     * @param ReadCategoryQuery $query
     */
    public function handle(Query $query): ReadPostQueryResponse
    {
        $postId = PostId::fromInt($query->id());

        $post = $this->postRepository->findById($postId);

        if (null === $post) {
            throw PostNotFound::ofId($postId);
        }

        return new ReadPostQueryResponse($post);
    }
}
