<?php declare(strict_types=1);

namespace Tests\Double\Spy\Bus;

use Airzone\Shared\Cqrs\CommandHandler;
use Airzone\Shared\Cqrs\Command;

final class CommandHandlerSpy implements CommandHandler
{
    private bool $hasHandledCommand = false;

    public function handle(Command $command): void
    {
        $this->hasHandledCommand = true;
    }

    public function hasHandledCommand(): bool
    {
        return $this->hasHandledCommand;
    }
}
