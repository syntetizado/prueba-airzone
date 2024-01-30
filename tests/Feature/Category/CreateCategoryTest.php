<?php

use Airzone\Infrastructure\Model\CategoryDao;
use Airzone\Shared\DbHelper;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

beforeEach(fn() => DB::beginTransaction());
afterEach(fn() => DB::rollBack());

it('creates a main category successfully', function () {
    $id = DbHelper::nextIdForTable('categories');
    $faker = Factory::create();

    $data = [
        'parent_id' => null,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ];

    $response = $this->post('/categories', $data);
    $response->assertStatus(200);

    $categoryDao = CategoryDao::find($id);

    $this->assertNotNull($categoryDao, 'Category was not saved');
    $this->assertEquals($data, [
        'parent_id' => $categoryDao->parent_id,
        'id' => $categoryDao->id,
        'name' => $categoryDao->name,
        'slug' => $categoryDao->slug,
        'visible' => $categoryDao->visible
    ]);
});

it('creates a sub category successfully', function () {
    $id = DbHelper::nextIdForTable('categories');
    $id2 = $id + 1;
    $faker = Factory::create();

    $categoryData = [
        'parent_id' => null,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ];
    $subCategoryData = [
        'parent_id' => $id,
        'id' => $id2,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ];

    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(200);

    $categoryDao = CategoryDao::find($id);

    $this->assertNotNull($categoryDao, 'There was a problem while saving the category');
    $this->assertEquals($categoryData, [
        'parent_id' => $categoryDao->parent_id,
        'id' => $categoryDao->id,
        'name' => $categoryDao->name,
        'slug' => $categoryDao->slug,
        'visible' => $categoryDao->visible
    ]);

    $response = $this->post('/categories', $subCategoryData);
    $response->assertStatus(200);

    $subCategoryDao = CategoryDao::find($id2);

    $this->assertNotNull($subCategoryDao, 'There was a problem while saving the sub-category');
    $this->assertEquals($subCategoryData, [
        'parent_id' => $subCategoryDao->parent_id,
        'id' => $subCategoryDao->id,
        'name' => $subCategoryDao->name,
        'slug' => $subCategoryDao->slug,
        'visible' => $subCategoryDao->visible
    ]);
});

it('fails creating category when parent not found', function () {
    $id = DbHelper::nextIdForTable('categories');
    $id2 = $id + 1;
    $faker = Factory::create();

    $categoryData = [
        'parent_id' => $id2,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ];

    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(409);

    $this->assertNull(CategoryDao::find($id), 'No record should be created');
});

it('fails creating category when request is bad', function () {
    $faker = Factory::create();
    $id = DbHelper::nextIdForTable('categories');

    $this->assertNull(CategoryDao::find($id), 'Id is already taken');

    $response = $this->post('/categories', [
        'parent_id' => null,
        'id' => null,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ]);
    $response->assertStatus(400);

    $response = $this->post('/categories', [
        'parent_id' => null,
        'id' => $id,
        'name' => null,
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ]);
    $response->assertStatus(400);

    $response = $this->post('/categories', [
        'parent_id' => null,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => null,
        'visible' => $faker->boolean(),
    ]);
    $response->assertStatus(400);

    $response = $this->post('/categories', [
        'parent_id' => null,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => null,
    ]);
    $response->assertStatus(400);

    $this->assertNull(CategoryDao::find($id), 'No record should have been created');
});

it('fails creating category when it exists', function () {
    $id = DbHelper::nextIdForTable('categories');
    $faker = Factory::create();

    $categoryData = [
        'parent_id' => null,
        'id' => $id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'visible' => $faker->boolean(),
    ];

    $this->assertNull(CategoryDao::find($id), 'Id is already taken');

    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(200);

    $savedCategoryDao = CategoryDao::find($id);
    $oldName = $categoryData['name'];
    $categoryData['name'] = 'name_2';

    $response = $this->post('/categories', $categoryData);
    $response->assertStatus(409);

    expect($savedCategoryDao->name)->toBe($oldName);
});
