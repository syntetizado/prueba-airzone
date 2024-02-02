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

    // check the category was not saved
    $lastRecord = CategoryDao::orderBy('id', 'desc')->first();

    $this->assertEquals($lastRecord->name, $categoryData['name']);
    $this->assertEquals($lastRecord->slug, $categoryData['slug']);
    $this->assertEquals($lastRecord->visible, $categoryData['visible']);
})->with([
    [CategoryAmo::create()],
    [CategoryAmo::create()],
    [CategoryAmo::create()],
]);

it('returns not found on non existing category', function () {
    $response = $this->put("/categories/0", CategoryAmo::create());
    $response->assertStatus(404);
});
