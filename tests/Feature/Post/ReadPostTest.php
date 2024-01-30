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
    $postId = DbHelper::nextIdForTable('posts');
    $ownerUserId = DbHelper::nextIdForTable('user');
    $commentWriterUserId = $ownerUserId + 1;
    $commentId = DbHelper::nextIdForTable('comments');

    /** @var UserDaoFactory $userDaoFactory */
    $userDaoFactory = \app(UserDaoFactory::class);
    /** @var CommentDaoFactory $commentDaoFactory */
    $commentDaoFactory = \app(CommentDaoFactory::class);
    /** @var PostDaoFactory $postDaoFactory */
    $postDaoFactory = \app(PostDaoFactory::class);

    /** @var UserDao $ownerUserDao */
    $ownerUserDao = $userDaoFactory->create();
    $ownerUserDao->id = $ownerUserId;
    $ownerUserDao->save();

    /** @var UserDao $commentWriterUserDao */
    $commentWriterUserDao = $userDaoFactory->create();
    $commentWriterUserDao->id = $commentWriterUserId;
    $commentWriterUserDao->save();

    /** @var CommentDao $commentDao */
    $commentDao = $commentDaoFactory->create();
    $commentDao->id = $commentId;
    $commentDao->user = $commentWriterUserId;
    $commentDao->save();

    /** @var PostDao $postDao */
    $postDao = $postDaoFactory->create();
    $postDao->id = $postId;
    $postDao->user = $commentWriterUserId;
    $postDao->comments()->save($commentDao);
    $postDao->save();

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
        'user' => $commentWriterUserDao->user,
        'datetime' => $commentDao->datetime,
        'content' => $commentDao->content,
    ];

    $post = [
        'id' => $postId,
        'title' => $postDao->title,
        'short_content' => $postDao->title,
        'owner' => $owner,
        'users' => [$commentWriter],
        'comments' => [$comment],
    ];

    $data = [
        'body' => [
            'post' => $post
        ]
    ];

    $response = $this->get("/posts/$postId");
    $response->assertStatus(200);

    $response->assertExactJson($data);
});

it('returns not found on non existing post', function () {
    $postId = DbHelper::nextIdForTable('posts');

    $response = $this->get("/posts/$postId");
    $response->assertStatus(404);
});
