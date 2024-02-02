<?php

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('deletes a main category successfully', function () {
    $categoryDao = CategoryDaoFactory::new()->create();
    $categoryId = $categoryDao->id;

    $response = $this->delete("/categories/$categoryId");
    $response->assertStatus(200);

    $this->assertNull(CategoryDao::find($categoryId));
});

it('returns not found on non existing category', function () {
    $response = $this->delete("/categories/0");
    $response->assertStatus(404);
});
