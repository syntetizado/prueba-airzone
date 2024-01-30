<?php

use Airzone\Infrastructure\Model\CategoryDao;
use Airzone\Infrastructure\Model\CommentDao;
use Airzone\Infrastructure\Model\Factory\CommentDaoFactory;
use Airzone\Infrastructure\Model\Factory\PostDaoFactory;
use Airzone\Infrastructure\Model\Factory\UserDaoFactory;
use Airzone\Infrastructure\Model\PostDao;
use Airzone\Infrastructure\Model\UserDao;
use Airzone\Shared\DbHelper;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('reads a post successfully', function () {
    /** @var UserDaoFactory $userDaoFactory */
    $userDaoFactory = \app(UserDaoFactory::class);
    /** @var CommentDaoFactory $commentDaoFactory */
    $commentDaoFactory = \app(CommentDaoFactory::class);
    /** @var PostDaoFactory $postDaoFactory */
    $postDaoFactory = \app(PostDaoFactory::class);

    /** @var UserDao $ownerUserDao */
    $ownerUserDao = $userDaoFactory->create();
    /** @var UserDao $commentWriterUserDao */
    $commentWriterUserDao = $userDaoFactory->create();
    /** @var CommentDao $commentDao */
    $commentDao = $commentDaoFactory->create(['user' => $commentWriterUserDao->id]);
    /** @var PostDao $postDao */
    $postDao = $postDaoFactory->create(['user' => $ownerUserDao->id]);

    $commentDao->user = $commentWriterUserDao->id;
    $commentDao->post_id = $postDao->id;
    $commentDao->save();

    $owner = [
        'id' => $ownerUserDao->id,
        'username' => $ownerUserDao->username,
        'full_name' => $ownerUserDao->full_name
    ];

    $commentWriter = [
        'id' => $commentWriterUserDao->id,
        'username' => $commentWriterUserDao->username,
        'full_name' => $commentWriterUserDao->full_name
    ];

    $comment = [
        'id' => $commentDao->id,
        'user' => $commentWriterUserDao->id,
        'datetime' => $commentDao->datetime->format(DateTime::W3C),
        'content' => $commentDao->content,
    ];

    $post = [
        'id' => $postDao->id,
        'title' => $postDao->title,
        'short_content' => $postDao->short_content,
        'owner' => $owner,
        'users' => [$commentWriter],
        'comments' => [$comment],
    ];

    $data = [
        'body' => [
            'post' => $post
        ]
    ];

    $response = $this->get("/posts/".$postDao->id);
    $response->assertStatus(200);

    $response->assertJson($data);
});

it('returns not found on non existing post', function () {
    $postId = DbHelper::nextIdForTable('posts');

    $response = $this->get("/posts/$postId");
    $response->assertStatus(404);
});
