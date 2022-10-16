<?php

declare(strict_types=1);

namespace App\Controller;

use App\CQRS\command\User\Create\CreateUserCommand;
use App\CQRS\command\User\Create\CreateUserCommandHandler;
use App\CQRS\Query\User\GetUserById\GetUserByIdQuery;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\SimpleCache\CacheInterface;
use Spiral\Broadcasting\BroadcastInterface;
use Spiral\Cqrs\CommandBusInterface;
use Spiral\Cqrs\QueryBusInterface;
use Spiral\Queue\QueueInterface;
use Spiral\Router\Annotation\Route;

class UserController
{
    public function __construct(
        private readonly BroadcastInterface $broadcast,
        private readonly QueueInterface $jobQueue,
        private readonly CacheInterface $cache,
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(route: '/users/<id>', methods: 'GET', group: 'api')]
    public function get(string $id): array
    {
        $this->cache->set('controller', $id);

        $this->broadcast->publish(
            'user.5',
            'Hello from Http Controller. UserId: ' . $id
        );

        $this->jobQueue->push('sample::job', ['userId' => $id . 5]);

        $this->commandBus->dispatch(CreateUserCommand::create('John', 35));
        $result = $this->queryBus->ask(new GetUserByIdQuery($id));

        return [
            'status' => 201,
            'data'   => [
                'id' => $result
            ]
        ];
    }

    #[Route(route: '/users', methods: 'GET', group: 'api')]
    public function all(): array
    {
        return ['Ok'];
    }

    #[Route(route: '/users', methods: 'POST', group: 'api')]
    public function create(CreateUserCommand $command): array
    {
        return ['Ok'];
    }
}
