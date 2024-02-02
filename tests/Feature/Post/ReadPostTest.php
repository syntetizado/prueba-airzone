<?php

use Airzone\Infrastructure\Repository\Factory\CommentDaoFactory;
use Airzone\Infrastructure\Repository\Factory\PostDaoFactory;
use Airzone\Infrastructure\Repository\Factory\UserDaoFactory;
use Airzone\Infrastructure\Repository\Model\CommentDao;
use Airzone\Infrastructure\Repository\Model\PostDao;
use Airzone\Infrastructure\Repository\Model\UserDao;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('reads a post successfully', function () {
    // first, it generates the needed data for reading
    $userDaoFactory = UserDaoFactory::new();

    /** @var UserDao $ownerUserDao */
    $ownerUserDao = $userDaoFactory->create();

    /** @var UserDao $commentWriterUserDao */
    $commentWriterUserDao = $userDaoFactory->create();

    /** @var PostDao $postDao */
    $postDao = PostDaoFactory::new()->create(['user' => $ownerUserDao->id]);

    /** @var CommentDao $commentDao */
    $commentDao = CommentDaoFactory::new()->create([
        'user' => $commentWriterUserDao,
        'post_id' => $postDao
    ]);

    // this is the expected return
    $expectedData = [
        'body' => [
            'post' => [
                'id' => $postDao->id,
                'title' => $postDao->title,
                'short_content' => $postDao->short_content,
                'owner' => [
                    'id' => $ownerUserDao->id,
                    'username' => $ownerUserDao->username,
                    'full_name' => $ownerUserDao->full_name
                ],
                'users' => [
                    [
                        'id' => $commentWriterUserDao->id,
                        'username' => $commentWriterUserDao->username,
                        'full_name' => $commentWriterUserDao->full_name
                    ]
                ],
                'comments' => [
                    [
                        'id' => $commentDao->id,
                        'user' => $commentWriterUserDao->id,
                        'datetime' => $commentDao->datetime->format(DateTime::W3C),
                        'content' => $commentDao->content,
                    ]
                ],
            ]
        ]
    ];

    $response = $this->get("/posts/" . $postDao->id);
    $response->assertStatus(200);
    $response->assertJson($expectedData);
});

it('returns not found on non existing post', function () {
    // it needs an ID that we know DBs never have, so we test if it throws not found with ID 0
    $response = $this->get("/posts/0");
    $response->assertStatus(404);
});
