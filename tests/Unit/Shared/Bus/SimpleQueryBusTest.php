<?php declare(strict_types=1);

use Airzone\Shared\Cqrs\QueryBus\SimpleQueryBus;
use Tests\Double\Dummy\Bus\FooQuery;
use Tests\Double\Dummy\Bus\FooQueryResponse;
use Tests\Double\Spy\Bus\QueryHandlerSpy;

it('registers a query successfully', function () {
    $simpleQueryBus = new SimpleQueryBus;
    $fooQuery = new FooQuery;
    $barHandlerSpy = new QueryHandlerSpy;

    $simpleQueryBus->register($fooQuery::class, $barHandlerSpy);
    $response = $simpleQueryBus->handle($fooQuery);

    \expect($response)->toEqual(new FooQueryResponse);
    $this->assertTrue($barHandlerSpy->hasHandledQuery());
});

it('fails when query is not registered', function () {
    $this->expectException(InvalidArgumentException::class);

    $simpleQueryBus = new SimpleQueryBus;
    $fooQuery = new FooQuery;

    $simpleQueryBus->handle($fooQuery);
});

