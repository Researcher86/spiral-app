<?php

declare(strict_types=1);

use Psr\Log\LogLevel;
use Spiral\Broadcasting\Driver\LogBroadcast;
use Spiral\Broadcasting\Driver\NullBroadcast;
use Spiral\Core\Container\Autowire;
use Spiral\RoadRunnerBridge\Broadcasting\RoadRunnerBroadcast;
use Spiral\RoadRunnerBridge\Broadcasting\RoadRunnerGuard;

return [
    'default' => env('BROADCAST_CONNECTION', 'roadrunner'),

    'authorize' => [
        'path' => env('BROADCAST_AUTHORIZE_PATH'),
        'topics' => [
            // 'topic' => static fn (ServerRequestInterface $request): bool => $request->getHeader('SECRET')[0] == 'secret',
            // 'user.{id}' => static fn ($id, Actor $actor): bool => $actor->getId() === $id
        ],
    ],

    'connections' => [
        'null' => [
            'driver' => 'null',
        ],
        'log' => [
            'driver' => 'log',
            'level' => LogLevel::INFO,
        ],
        'roadrunner' => [
            'driver' => 'roadrunner',
            'guard' => Autowire::wire(RoadRunnerGuard::class),
        ]
    ],
    'driverAliases' => [
        'null' => NullBroadcast::class,
        'log' => LogBroadcast::class,
        'roadrunner' => RoadRunnerBroadcast::class,
    ],
];
