<?php declare(strict_types=1);

namespace Airzone\Shared\Exception;

final class InvalidString extends ApiException
{
    public static function byRegexAndValue(string $regex, string $value): InvalidString
    {
        return new self(\sprintf("The string (%s) does not comply the regex (%s)", $value, $regex));
    }

    public static function byExceedingMaxCharacters(int $maxCharacters, string $value): InvalidString
    {
        return new self(\sprintf("The string (%s) has more than (%s) characters", $value, $maxCharacters));
    }
}
