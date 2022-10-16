<?php

declare(strict_types=1);

$generator = \Butschster\CronExpression\Generator::create();

return [
    'queueConnection' => env('SCHEDULER_QUEUE_CONNECTION', 'sync'),
    'cacheStorage' => env('SCHEDULER_CACHE_STORAGE', 'redis'), // for mutexes
    'timezone' => 'UTC',
    'expression' => [
        'aliases' => [
            '@everyMinute' => (string)$generator->everyMinute(),
            '@everyFiveMinutes' => (string)$generator->everyFiveMinutes(),
            '@everyFifteenMinutes' => (string)$generator->everyFifteenMinutes(),
        ],
    ],
];
