<?php

declare(strict_types=1);

namespace App\Job;

use Spiral\Broadcasting\BroadcastInterface;
use Spiral\Queue\JobHandler;

/**
 * (QueueInterface)->push(SampleJob::class, ["userId"=> 5]);
 */
class SampleJob extends JobHandler
{
    public function invoke(BroadcastInterface $broadcast, string $userId): void
    {
        echo 'Start WebSocket Broadcast...';
        sleep(10);
        $broadcast->publish(
            'user.5',
            'Hello from Background Job. UserId: ' . $userId
        );
    }
}
