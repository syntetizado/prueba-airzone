<?php

use Airzone\Infrastructure\Repository\Factory\CommentDaoFactory;
use Airzone\Infrastructure\Repository\Factory\UserDaoFactory;
use Airzone\Infrastructure\Repository\Model\UserDao;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('brings its comments successfully', function () {
    /**
     * @var UserDao $userDao
     * @var Collection $comments
     */
    $userDao = UserDaoFactory::new()->create();
    $comments = CommentDaoFactory::new()->createMany(10);

    $comments->toQuery()->update(array("user" => $userDao->id));
    $comments->fresh();

    $userIds = $userDao->comments()->distinct()->pluck('user');

    \expect($userIds)->toHaveCount(1)
        ->and($userIds->first())->toBe($userDao->id);
});
