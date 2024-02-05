<?php declare(strict_types=1);

namespace Airzone\Shared;

use Airzone\Shared\Exception\InvalidCollection;

abstract class Collection
{
    /** This const must be used for declaring the <b>collection items</b> class */
    protected const TYPE = null;

    // Don't doc this exception, not very useful having it everywhere on the code
    protected function __construct(protected array $items = [])
    {
        $this->validate();
    }

    /**
     * Validates the Collection
     * @throws InvalidCollection
     */
    private function validate(): void
    {
        $class = static::TYPE;

        foreach ($this->items as $item) {
            if ($item instanceof $class) {
                continue;
            }

            throw InvalidCollection::byItem($item);
        }
    }

    /** Named constructor taking an array of items */
    public static function fromArray(array $items): static
    {
        $class = static::TYPE;

        return new static(\array_map(
            callback: fn($item) => \is_array($item)
                ? $class::fromArray($item)
                : $item,
            array: $items
        ));
    }

    /** Returns an array with all items data */
    public function toArray(): array
    {
        $array = [];

        foreach ($this->items as $item) {
            if (! $item instanceof Aggregate) {
                $array[] = $item;
                continue;
            }

            $array[] = $item->toArray();
        }

        return $array;
    }

    /** Named constructor creating an empty Collection */
    public static function empty(): static
    {
        return new static;
    }
}
