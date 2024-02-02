<?php declare(strict_types=1);

namespace Airzone\Domain\Category;

use Airzone\Shared\Exception\InvalidString;
use Airzone\Shared\Exception\NegativeId;

final readonly class Category
{
    private function __construct(
        private ?CategoryId $id,
        private Name $name,
        private Slug $slug,
        private bool $visible,
        private ?CategoryId $parentId = null,
    ) {
    }

    /**
     * @throws NegativeId
     * @throws InvalidString
     */
    public static function fromValues(array $values): self
    {
        $id = $values['id'] ?? null;

        return new self(
            id: null === $id ? null : CategoryId::fromInt($values['id']),
            name: Name::fromString($values['name']),
            slug: Slug::fromString($values['slug']),
            visible: $values['visible'],
            parentId: $values['parent_id']
                ? CategoryId::fromInt($values['parent_id'])
                : null
        );
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function parentId(): ?CategoryId
    {
        return $this->parentId;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function slug(): Slug
    {
        return $this->slug;
    }

    public function visible(): bool
    {
        return $this->visible;
    }

    public function withUpdatedValues(array $valuesToUpdate): self
    {
        $valuesToUpdate['id'] = $this->id->value();

        return self::fromValues($valuesToUpdate);
    }
}
