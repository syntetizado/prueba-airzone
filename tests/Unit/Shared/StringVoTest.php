<?php declare(strict_types=1);

use Airzone\Shared\Exception\InvalidString;
use Tests\Double\Fake\StringVo\CombinedValidationsStringVoFake;
use Tests\Double\Fake\StringVo\MaxCharsStringVoFake;
use Tests\Double\Fake\StringVo\RegexStringVoFake;

it('fails when string is too long', function () {
    $this->expectException(InvalidString::class);
    $this->expectExceptionCode(400);

    MaxCharsStringVoFake::fromString('This is longer than 10 chars');
});

it('fails when string does not comply the regex', function () {
    $this->expectException(InvalidString::class);
    $this->expectExceptionCode(400);

    RegexStringVoFake::fromString('this is n0t a v9l1d str1ng');
});

it('fails when both validations are checked', function (string $invalidString) {
    $this->expectException(InvalidString::class);
    CombinedValidationsStringVoFake::fromString($invalidString);
})->with([
    'h9s number',
    'does not have number but exceeds in characters',
    'this is t00 greedy and 1ll3gal, it breaks t00 many laws',
]);

it('generates a string correctly', function () {
    $this->expectNotToPerformAssertions();

    CombinedValidationsStringVoFake::generate();
})->repeat(20);
