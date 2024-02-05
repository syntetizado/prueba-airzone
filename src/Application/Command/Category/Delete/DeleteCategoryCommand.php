<?php declare(strict_types=1);

namespace Airzone\Application\Command\Category\Delete;

use Airzone\Shared\Cqrs\Command;

final readonly class DeleteCategoryCommand extends Command
{
    public function __construct(private int $id)
    {
    }

    public function id(): int
    {
        return $this->id;
    }
}
