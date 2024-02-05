<?php declare(strict_types=1);

use Airzone\Domain\Category\Category;
use Airzone\Domain\Category\Name;
use Airzone\Domain\Category\Slug;
use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;
use Tests\Double\ArrayMotherObject\CategoryAmo;
use Tests\Double\MotherObject\CategoryMo;

it('builds correctly 3 times', function (array $categoryData) {
    $category = Category::fromValues($categoryData);

    expect($category->name())->toEqual(Name::fromString($categoryData['name']))
        ->and($category->slug())->toEqual(Slug::fromString($categoryData['slug']))
        ->and($category->parentId())->toEqual($categoryData['parent_id'])
        ->and($category->visible())->toBe($categoryData['visible'])
    ;
})->with([
    [CategoryAmo::create()],
    [CategoryAmo::create()],
    [CategoryAmo::create()],
]);

it('fails when name is invalid', function (string $invalidName) {
    $this->expectException(InvalidString::class);

    CategoryMo::createWithValues(['name' => $invalidName]);
})->with([
    ['@this is not valid.com'],
    ['this is not% && valid'],
    ['46346 466664 4'],
]);

it('fails when slug is invalid', function (string $invalidSlug) {
    $this->expectException(InvalidString::class);

    CategoryMo::createWithValues(['slug' => $invalidSlug]);
})->with([
    ['this_is_not_valid'],
    ['this is not valid'],
    ['@thisisnotvalid'],
]);

it('fails with invalid parent id', function () {
    $this->expectException(NegativeId::class);

    CategoryMo::createWithValues(['parent_id' => -5]);
});
