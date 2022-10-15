<?php

declare(strict_types=1);

namespace App\Controller;

use App\CQRS\command\User\Create\CreateCommand;
use Spiral\Broadcasting\BroadcastInterface;
use Spiral\Queue\QueueInterface;
use Spiral\Router\Annotation\Route;

class UserController
{
    public function __construct(private readonly BroadcastInterface $broadcast, private readonly QueueInterface $jobQueue)
    {
    }

    #[Route(route: '/users/<id>', methods: 'GET', group: 'api')]
    public function get(string $id): array
    {
        $this->broadcast->publish(
            'user.5',
            'Hello from Http Controller. UserId: ' . $id
        );

        $this->jobQueue->push('sample::job', ['userId' => $id . 5]);

        return [
            'status' => 201,
            'data'   => [
                'id' => $id
            ]
        ];
    }

    #[Route(route: '/users', methods: 'GET', group: 'api')]
    public function all(): array
    {
        return ['Ok'];
    }

    #[Route(route: '/users', methods: 'POST', group: 'api')]
    public function create(CreateCommand $command): array
    {
        return ['Ok'];
    }
}
