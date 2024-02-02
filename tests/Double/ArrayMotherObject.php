<?php declare(strict_types=1);

namespace Tests\Double;

/*
Mother objects are used for generating entities
that you can use in your tests,
they should always return valid data.

In this case, it returns valid objects as arrays.
*/
abstract class ArrayMotherObject
{
    abstract public static function create(): array;
}
