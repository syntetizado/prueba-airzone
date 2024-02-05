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

it('brings comments relations successfully', function () {
    /**
     * @var PostDao $postDao
     * @var UserDao $userDao
     * @var CommentDao $commentDao
     */
    $postDao = PostDaoFactory::new()->create();
    $userDao = UserDaoFactory::new()->create();
    $commentDao = CommentDaoFactory::new()->create();

    $commentDao->post()->associate($postDao);
    $commentDao->writer()->associate($userDao);

    $commentWriterDao = $commentDao->writer;
    $commentPostDao = $commentDao->post;

    \expect($commentDao->user)->toBe($commentWriterDao->id)
        ->and($commentDao->post_id)->toBe($commentPostDao->id);
});
