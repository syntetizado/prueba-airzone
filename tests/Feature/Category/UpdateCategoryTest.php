<?php

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Support\Facades\DB;
use Tests\Double\ArrayMotherObject\CategoryAmo;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('updates a main category successfully', function (array $categoryData) {
    $categoryDao = CategoryDaoFactory::new()->create();
    $categoryId = $categoryDao->id;

    $response = $this->put("/categories/$categoryId", $categoryData);
    $response->assertStatus(200);

    // check the category was saved
    $lastRecord = CategoryDao::orderBy('id', 'desc')->first();

    $this->assertEquals($lastRecord->name, $categoryData['name']);
    $this->assertEquals($lastRecord->slug, $categoryData['slug']);
    $this->assertEquals($lastRecord->visible, $categoryData['visible']);
})->with([
    [CategoryAmo::create()],
    [CategoryAmo::create()],
    [CategoryAmo::create()],
]);

it('updates a main category parent id successfully', function () {
    $categoryDao = CategoryDaoFactory::new()->create();
    $parentCategoryDao = CategoryDaoFactory::new()->create();

    $categoryId = $categoryDao->id;
    $parentCategoryId = $parentCategoryDao->id;

    $response = $this->put("/categories/$categoryId", CategoryAmo::withValues(['parent_id' => $parentCategoryId]));
    $response->assertStatus(200);

    // check the category was updated
    $updatedCategoryDao = CategoryDao::find($categoryId);

    $this->assertEquals($updatedCategoryDao->parent_id, $parentCategoryId);
});

it('fails updating category when request is bad', function (array $categoryData) {
    $categoryDao = CategoryDaoFactory::new()->create();
    $categoryId = $categoryDao->id;

    $response = $this->put("/categories/$categoryId", $categoryData);
    $response->assertStatus(400);
})->with([
    [CategoryAmo::withNullParameter('name')],
    [CategoryAmo::withNullParameter('slug')],
    [CategoryAmo::withNullParameter('visible')]
]);

it('returns not found on non existing category', function () {
    $response = $this->put("/categories/0", CategoryAmo::create());
    $response->assertStatus(404);
});

it('fails on non existing category parent', function () {
    $categoryDao = CategoryDaoFactory::new()->create();
    $categoryId = $categoryDao->id;

    $response = $this->put("/categories/$categoryId", CategoryAmo::withValues(['parent_id' => 0]));
    $response->assertStatus(409);
});

