<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

interface CommandHandler
{
    public function handle(Command $command): void;
}
