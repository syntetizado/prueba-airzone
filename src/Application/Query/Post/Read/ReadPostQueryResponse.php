<?php declare(strict_types=1);

namespace Airzone\Application\Query\Post\Read;

use Airzone\Domain\Post\Post;
use Airzone\Shared\Cqrs\QueryResponse;

final readonly class ReadPostQueryResponse extends QueryResponse
{
    public function __construct(private Post $post)
    {
    }

    function toArray(): array
    {
        return [
            'body' => [
                'post' => $this->post->toArray()
            ]
        ];
    }
}
