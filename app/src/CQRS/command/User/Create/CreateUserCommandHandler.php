<?php

declare(strict_types=1);

namespace App\CQRS\command\User\Create;

use App\CQRS\command\User\Event\CreatedUserEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Spiral\Cqrs\Attribute\CommandHandler;

class CreateUserCommandHandler
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    #[CommandHandler]
    public function __invoke(CreateUserCommand $command): string
    {

        $this->eventDispatcher->dispatch(new CreatedUserEvent('555'));

        return '555';
    }
}
