<?php declare(strict_types=1);

namespace Airzone\Shared\Cqrs;

interface CommandBus
{
    public function handle(Command $command): void;
}
