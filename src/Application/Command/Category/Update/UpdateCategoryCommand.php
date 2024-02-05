<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Update;

use Airzone\Shared\Cqrs\Command;

final readonly class UpdateCategoryCommand extends Command
{
    public function __construct(
        private int $id,
        private ?int $parentId,
        private string $name,
        private string $slug,
        private bool $visible,
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function parentId(): ?int
    {
        return $this->parentId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function visible(): bool
    {
        return $this->visible;
    }
}
