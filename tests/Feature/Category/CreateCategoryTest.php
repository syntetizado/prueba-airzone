<?php

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Illuminate\Support\Facades\DB;
use Tests\Double\ArrayMotherObject\CategoryAmo;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('creates a main category successfully', function () {
    // it creates an array with valid category data
    $categoryData = CategoryAmo::create();

    // This is the SUT (Subject Under Testing), then it launches a real request
    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(200);

    // Now it rescues the new id from the response
    $createdInstanceId = $response->json(['id']);

    // Now it queries for the data temporarily stored in our DB (we are on a transaction)
    $categoryDao = CategoryDao::find($createdInstanceId);

    // And assert all data is the same as the one it was inserted
    $this->assertNotNull($categoryDao, 'Category was not saved');
    $this->assertEquals($categoryData, [
        'id' => null,
        'parent_id' => $categoryDao->parent_id,
        'name' => $categoryDao->name,
        'slug' => $categoryDao->slug,
        'visible' => $categoryDao->visible
    ]);
});

it('creates a child category successfully', function () {
    $parentCategoryData = CategoryAmo::create();

    // It creates a category that the sub-category can be attached to
    $response = $this->post('/categories', $parentCategoryData);
    $response->assertStatus(200);

    // Now it rescues the parent id from the response
    $parentCategoryId = $response->json(['id']);

    // it creates an array with valid child category data
    $childCategoryData = CategoryAmo::create(parentId: $parentCategoryId);

    // This is the SUT
    $response = $this->post('/categories', $childCategoryData);
    $response->assertStatus(200);

    // Now it rescues the child id from the response
    $childCategoryId = $response->json(['id']);

    $childCategoryDao = CategoryDao::find($childCategoryId);

    $this->assertNotNull($childCategoryDao, 'There was a problem while saving the sub-category');
    $this->assertEquals($childCategoryData, [
        'id' => null,
        'parent_id' => $childCategoryDao->parent_id,
        'name' => $childCategoryDao->name,
        'slug' => $childCategoryDao->slug,
        'visible' => $childCategoryDao->visible
    ]);
});

it('fails creating category when parent not found', function () {
    // it creates an array with a parent we will not find
    $categoryData = CategoryAmo::create(parentId: 0);

    // it tries to create a category, it must fail
    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(409);

    // check the category was not saved
    $lastRecord = CategoryDao::orderBy('id', 'desc')->first();

    $this->assertNotEquals($categoryData, [
        'id' => null,
        'parent_id' => $lastRecord->parent_id,
        'name' => $lastRecord->name,
        'slug' => $lastRecord->slug,
        'visible' => $lastRecord->visible
    ]);
});

// this test is using datasets to create multiple tests easily
it('fails creating category when request is bad', function (array $categoryData) {
    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(400);
})->with([
    [CategoryAmo::withNullParameter('name')],
    [CategoryAmo::withNullParameter('slug')],
    [CategoryAmo::withNullParameter('visible')]
]);

it('fails creating category when it exists', function () {
    $categoryData = CategoryAmo::create();

    // first time saving it will say ok
    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(200);

    // second time saving it will fail as it's using the same data
    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(409);
});
