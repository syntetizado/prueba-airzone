<?php

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('brings its parent successfully', function () {
    /**
     * @var CategoryDao $categoryParentDao
     * @var CategoryDao $categoryDao
     */
    $categoryParentDao = CategoryDaoFactory::new()->create();
    $categoryDao = CategoryDaoFactory::new()->create(parent: $categoryParentDao);

    $categoryDao->parent()->associate($categoryParentDao);

    $parentObtainedFromChild = $categoryDao->parent;

    \expect($parentObtainedFromChild->id)->toBe($categoryParentDao->id);
});
