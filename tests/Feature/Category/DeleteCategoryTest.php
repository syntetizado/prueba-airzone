<?php

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Airzone\Shared\DbHelper;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('deletes a main category successfully', function () {
    $id = DbHelper::nextIdForTable('categories');

    $faker = Factory::create();

    $categoryDao = new CategoryDao();
    $categoryDao->id = $id;
    $categoryDao->name = $faker->name();
    $categoryDao->slug = $faker->slug();
    $categoryDao['visible'] = $faker->boolean();

    $categoryDao->save();

    $response = $this->delete("/categories/$id");
    $response->assertStatus(200);

    $this->assertNull(CategoryDao::find($id));
});

it('returns not found on non existing category', function () {
    $id = DbHelper::nextIdForTable('categories');

    $this->assertNull(CategoryDao::find($id));

    $response = $this->delete("/categories/$id");
    $response->assertStatus(404);
});
