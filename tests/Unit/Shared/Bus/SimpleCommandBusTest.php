<?php declare(strict_types=1);

use Airzone\Shared\Cqrs\CommandBus\SimpleCommandBus;
use Tests\Double\Dummy\Bus\FooCommand;
use Tests\Double\Spy\Bus\CommandHandlerSpy;

it('registers a command successfully', function () {
    $simpleCommandBus = new SimpleCommandBus;
    $fooCommand = new FooCommand;
    $barHandlerSpy = new CommandHandlerSpy;

    $simpleCommandBus->register($fooCommand::class, $barHandlerSpy);
    $simpleCommandBus->handle($fooCommand);

    $this->assertTrue($barHandlerSpy->hasHandledCommand());
});

it('fails when command is not registered', function () {
    $this->expectException(InvalidArgumentException::class);

    $simpleCommandBus = new SimpleCommandBus;
    $fooCommand = new FooCommand();

    $simpleCommandBus->handle($fooCommand);
});

