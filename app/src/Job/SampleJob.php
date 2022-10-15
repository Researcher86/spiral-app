<?php

declare(strict_types=1);

namespace App\Job;

use Psr\SimpleCache\CacheInterface;
use Spiral\Broadcasting\BroadcastInterface;
use Spiral\Queue\JobHandler;

/**
 * (QueueInterface)->push(SampleJob::class, ["userId"=> 5]);
 */
class SampleJob extends JobHandler
{
    public function invoke(BroadcastInterface $broadcast, CacheInterface $cache,  string $userId): void
    {
        echo 'Start WebSocket Broadcast...' . PHP_EOL;
        echo 'Data from cache: ' . $cache->get('controller');


        sleep(1);
        $broadcast->publish(
            'user.5',
            'Hello from Background Job. UserId: ' . $userId
        );
    }
}
