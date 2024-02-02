<?php

use Airzone\Infrastructure\Repository\Model\CategoryDao;
use Airzone\Shared\DbHelper;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('updates a main category successfully', function () {
    $id = DbHelper::nextIdForTable('categories');

    $this->assertNull(CategoryDao::find($id));

    $faker = Factory::create();

    $categoryDao = new CategoryDao();
    $categoryDao->id = $id;
    $categoryDao->name = $faker->name();
    $categoryDao->slug = $faker->slug();
    $categoryDao['visible'] = true;

    $categoryDao->save();

    $response = $this->put("/categories/$id", ['name' => 'name_1']);
    $response->assertStatus(200);

    $this->assertEquals('name_1', CategoryDao::find($id)->name);

    $response = $this->put("/categories/$id", ['slug' => 'slug_1']);
    $response->assertStatus(200);

    $this->assertEquals('slug_1', CategoryDao::find($id)->slug);

    $response = $this->put("/categories/$id", ['visible' => false]);
    $response->assertStatus(200);

    $this->assertFalse(CategoryDao::find($id)['visible']);
});

it('returns not found on non existing category', function () {
    $id = DbHelper::nextIdForTable('categories');

    $response = $this->put("/categories/$id", ['name' => 'name_2']);
    $response->assertStatus(404);
});
