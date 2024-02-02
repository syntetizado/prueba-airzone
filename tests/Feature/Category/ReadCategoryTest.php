<?php

use Airzone\Infrastructure\Repository\Factory\CategoryDaoFactory;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('reads a main category successfully', function () {
    $categoryDao = CategoryDaoFactory::new()->create();
    $categoryId = $categoryDao->id;

    $response = $this->get("/categories/$categoryId");
    $response->assertStatus(200);

    $response->assertExactJson([
        'parent_id' => $categoryDao->parent_id,
        'name' => $categoryDao->name,
        'slug' => $categoryDao->slug,
        'visible' => $categoryDao['visible']
    ]);
});

it('returns not found on non existing category', function () {
    $response = $this->get("/categories/0");
    $response->assertStatus(404);
});
