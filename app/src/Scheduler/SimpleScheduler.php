<?php

declare(strict_types=1);

namespace App\Scheduler;

use Psr\Log\LoggerInterface;
use Spiral\Scheduler\Attribute\Schedule;

#[Schedule(
    name: 'Ping url',
    expression: '@everyMinute',
    runAs: 'root',
    withoutOverlapping: true,
//    runInBackground: true, // Если включить, то не будет работать хак с константой SPIRAL_BINARY
    parameters: ['url' => 'https://www.google.com/']
)]
class SimpleScheduler
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function run(LoggerInterface $logger, string $url): void
    {
        $headers = @get_headers($url);
        $status = $headers && \strpos($headers[0], '200');

        $this->logger->info(\sprintf('URL: %s %s', $url, $status ? 'Exists' : 'Does not exist'));
    }
}
