<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs\CommandBus;

use Airzone\Application\Command\Category\Create\CreateCategory;
use Airzone\Application\Command\Category\Create\CreateCategoryCommand;
use Airzone\Application\Command\Category\Delete\DeleteCategory;
use Airzone\Application\Command\Category\Delete\DeleteCategoryCommand;
use Airzone\Application\Command\Category\Update\UpdateCategory;
use Airzone\Application\Command\Category\Update\UpdateCategoryCommand;
use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandBus;
use Airzone\Shared\Cqrs\CommandHandler;

final class SimpleCommandBus implements CommandBus
{
    private array $commandHandlers;

    public function __construct()
    {
        $this->commandHandlers = [
            CreateCategoryCommand::class => \app(CreateCategory::class),
            DeleteCategoryCommand::class => \app(DeleteCategory::class),
            UpdateCategoryCommand::class => \app(UpdateCategory::class),
        ];
    }

    public function handle(Command $command): void
    {
        $commandName = $command::class;

        if (!isset($this->commandHandlers[$commandName])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'No valid handler found for command "%s"',
                    $commandName
                )
            );
        }

        /** @var CommandHandler $handler */
        $handler = $this->commandHandlers[$commandName];
        $handler->handle($command);
    }
}
