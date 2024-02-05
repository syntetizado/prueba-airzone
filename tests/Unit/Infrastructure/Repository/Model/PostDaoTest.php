<?php

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Factory\PostDaoFactory;
use Airzone\Infrastructure\Repository\Model\PostDao;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('brings its categories successfully', function () {
    /**
     * @var PostDao $postDao
     * @var Collection $categories
     */
    $postDao = PostDaoFactory::new()->create();
    $categories = CategoryDaoFactory::new()->createMany(10);

    $postDao->categories()->sync($categories);
    $categories->fresh();

    $postIds = $postDao->categories()->distinct()->pluck('blog');

    \expect($postIds)->toHaveCount(1)
        ->and($postIds->first())->toBe($postDao->id);
});
