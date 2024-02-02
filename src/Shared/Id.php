<?php declare(strict_types=1);

namespace Airzone\Shared;

use Airzone\Shared\Exception\NegativeId;

abstract readonly class Id
{
    /** @throws NegativeId */
    protected function __construct(private int $value)
    {
        $this->validate();
    }

    /** @throws NegativeId */
    public static function fromInt(int $value): static
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    /** @throws NegativeId */
    private function validate(): void
    {
        if ($this->value < 0) {
            throw NegativeId::byId($this);
        }
    }
}
