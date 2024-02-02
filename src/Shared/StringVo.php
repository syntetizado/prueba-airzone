<?php declare(strict_types=1);

namespace Airzone\Shared;

use Airzone\Shared\Exception\InvalidString;
use Faker\Factory;

abstract readonly class StringVo
{
    protected const REGEX = null;
    protected const MAX_CHARS = null;

    /** @throws InvalidString */
    protected function __construct(private string $value)
    {
        $this->validateRegex();
        $this->validateLength();
    }

    /** @throws InvalidString */
    public static function fromString(string $value): static
    {
        return new static($value);
    }

    /** @throws InvalidString */
    public static function generate(): static
    {
        $string = null === static::REGEX
            ? Factory::create()->text(static::MAX_CHARS)
            : Factory::create()->regexify(static::REGEX);

        if (!static::isValueValid($string)) {
            return static::generate();
        }

        return new static($string);
    }

    public function value(): string
    {
        return $this->value;
    }

    private static function isValueValid(string $value): bool
    {
        return static::isValueComplyingRegex($value) && static::isValueComplyingMaxChars($value);
    }

    private static function isValueComplyingMaxChars(string $value): bool
    {
        return null === static::MAX_CHARS || \strlen($value) <= static::MAX_CHARS;
    }

    private static function isValueComplyingRegex(string $value): bool
    {
        $regex = static::REGEX;
        return null === $regex || \preg_match_all($regex, $value) > 0;
    }

    /** @throws InvalidString */
    private function validateRegex(): void
    {
        if (!$this->isValueComplyingRegex($this->value)) {
            throw InvalidString::byRegexAndValue((string) static::REGEX, $this->value);
        }
    }

    /** @throws InvalidString */
    private function validateLength(): void
    {
        $maxChars = static::MAX_CHARS;

        if (\is_int($maxChars) && strlen($this->value) > $maxChars) {
            throw InvalidString::byExceedingMaxCharacters($maxChars, $this->value);
        }
    }
}
