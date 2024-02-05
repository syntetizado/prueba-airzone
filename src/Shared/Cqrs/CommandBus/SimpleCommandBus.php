<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs\CommandBus;

use Airzone\Shared\Cqrs\Command;
use Airzone\Shared\Cqrs\CommandBus;
use Airzone\Shared\Cqrs\CommandHandler;

class SimpleCommandBus implements CommandBus
{
    private array $commandHandlers;

    public function register(string $command, CommandHandler $handler): void
    {
        $this->commandHandlers[$command] = $handler;
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
