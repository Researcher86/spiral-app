<?php

declare(strict_types=1);

namespace App\CQRS\EventListener;

use App\CQRS\command\User\Event\CreatedUserEvent;
use Psr\SimpleCache\CacheInterface;
use Spiral\Broadcasting\BroadcastInterface;
use Spiral\Events\Attribute\Listener;
use Spiral\Queue\QueueInterface;

class CreatedUserEventListener
{
    public function __construct(
        private readonly BroadcastInterface $broadcast,
        private readonly QueueInterface $jobQueue,
        private readonly CacheInterface $cache
    ) {
    }

    #[Listener(event: CreatedUserEvent::class, priority: 1)]
    public function onEvent(CreatedUserEvent $event): void
    {
        $this->cache->set('handler', (int) $event->userId);

        $this->broadcast->publish(
            'user.5',
            'Hello from command handler. UserId: ' . $event->userId
        );

        $this->jobQueue->push('sample::job', ['userId' => $event->userId . 5]);
    }
}
