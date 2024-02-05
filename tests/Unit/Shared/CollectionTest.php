<?php declare(strict_types=1);

use Airzone\Shared\Exception\InvalidCollection;
use Tests\Double\Dummy\Bar;
use Tests\Double\Dummy\Foo;
use Tests\Double\Fake\Collection\FooCollectionFake;

it('fails when type is invalid', function () {
    $this->expectException(InvalidCollection::class);

    FooCollectionFake::fromArray([new Bar]);
});

it('returns objects correctly when they are not Aggregates', function () {
    $foo = new Foo;
    $collection = FooCollectionFake::fromArray([$foo]);

    expect($collection->toArray())->toBe([$foo]);
});

it('creates empty collection correctly', function () {
    $collection = FooCollectionFake::empty();

    expect($collection->toArray())->toBe([]);
});
