<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Create;

use Airzone\Shared\Cqrs\Command;

final readonly class CreateCategoryCommand extends Command
{
    public function __construct(
        private ?int $parentId,
        private string $name,
        private string $slug,
        private bool $visible,
    )
    {
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
