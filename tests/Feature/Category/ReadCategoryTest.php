<?php

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Airzone\Shared\DbHelper;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('reads a main category successfully', function () {
    $id = DbHelper::nextIdForTable('categories');

    $faker = Factory::create();

    $categoryDao = new CategoryDao();
    $categoryDao->id = $id;
    $categoryDao->name = $faker->name();
    $categoryDao->slug = $faker->slug();
    $categoryDao['visible'] = $faker->boolean();

    $categoryDao->save();

    $response = $this->get("/categories/$id");
    $response->assertStatus(200);

    $response->assertExactJson([
        'parent_id' => $categoryDao->parent_id,
        'id' => $categoryDao->id,
        'name' => $categoryDao->name,
        'slug' => $categoryDao->slug,
        'visible' => $categoryDao['visible']
    ]);
});

it('returns not found on non existing category', function () {
    $id = DbHelper::nextIdForTable('categories');

    $response = $this->get("/categories/$id");
    $response->assertStatus(404);
});
