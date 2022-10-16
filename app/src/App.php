<?php

declare(strict_types=1);

namespace App;

use App\Bootloader;
use App\Bootloader\DebugMiddlewareBootloader;
use App\Bootloader\ValidationMiddlewareBootloader;
use App\Bootloader\ViewRendererBootloader;
use Spiral\Boot\Bootloader\CoreBootloader;
use Spiral\Bootloader as Framework;
use Spiral\Bootloader\Http\ErrorHandlerBootloader;
use Spiral\Cqrs\Bootloader\CqrsBootloader;
use Spiral\Cycle\Bootloader as CycleBridge;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Events\Bootloader\EventsBootloader;
use Spiral\Framework\Kernel;
use Spiral\League\Event\Bootloader\EventBootloader;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\Nyholm\Bootloader as Nyholm;
use Spiral\RoadRunnerBridge\Bootloader as RoadRunnerBridge;
use Spiral\Router\Bootloader\AnnotatedRoutesBootloader;
use Spiral\Sapi\Bootloader\SapiBootloader;
use Spiral\Scaffolder\Bootloader as Scaffolder;
use Spiral\Scheduler\Bootloader\SchedulerBootloader;
use Spiral\Stempler\Bootloader as Stempler;
use Spiral\Tokenizer\Bootloader\TokenizerBootloader;
use Spiral\Validation\Symfony\Bootloader\ValidatorBootloader;

class App extends Kernel
{
    protected const SYSTEM = [
        CoreBootloader::class,
        TokenizerBootloader::class,
        DotEnv\DotenvBootloader::class,
    ];

    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected const LOAD = [
        // Logging and exceptions handling
        Monolog\MonologBootloader::class,
//        ErrorHandlerBootloader::class,
        SchedulerBootloader::class,

        EventsBootloader::class,
        EventBootloader::class,
        CqrsBootloader::class,

        Bootloader\ExceptionHandlerBootloader::class,

        // Application specific logs
        Bootloader\LoggingBootloader::class,

        // RoadRunner
        RoadRunnerBridge\CacheBootloader::class,
        RoadRunnerBridge\GRPCBootloader::class,
        RoadRunnerBridge\HttpBootloader::class,
        RoadRunnerBridge\QueueBootloader::class,
        RoadRunnerBridge\RoadRunnerBootloader::class,

        // Core Services
        Framework\SnapshotsBootloader::class,
        Framework\I18nBootloader::class,

        // Security and validation
        Framework\Security\EncrypterBootloader::class,
        ValidatorBootloader::class,
        Framework\Security\FiltersBootloader::class,
        Framework\Security\GuardBootloader::class,

        // HTTP extensions
        Nyholm\NyholmBootloader::class,
        Framework\Http\RouterBootloader::class,
        Framework\Http\JsonPayloadsBootloader::class,
        Framework\Http\CookiesBootloader::class,
        Framework\Http\SessionBootloader::class,
        Framework\Http\CsrfBootloader::class,
        Framework\Http\PaginationBootloader::class,
        Framework\Http\ErrorHandlerBootloader::class,
        SapiBootloader::class,

        // Databases
        CycleBridge\DatabaseBootloader::class,
        CycleBridge\MigrationsBootloader::class,
        // CycleBridge\DisconnectsBootloader::class,

        // ORM
        CycleBridge\SchemaBootloader::class,
        CycleBridge\CycleOrmBootloader::class,
        CycleBridge\AnnotatedBootloader::class,
        CycleBridge\CommandBootloader::class,

        // DataGrid
        // CycleBridge\DataGridBootloader::class,

        // Auth
        // CycleBridge\AuthTokensBootloader::class,

        // Entity checker
        // CycleBridge\ValidationBootloader::class,

        Framework\Views\TranslatedCacheBootloader::class,


        // Extensions and bridges
        Stempler\StemplerBootloader::class,

        // Framework commands
        Framework\CommandBootloader::class,
        Scaffolder\ScaffolderBootloader::class,

        // Debug and debug extensions
        Framework\DebugBootloader::class,
        Framework\Debug\LogCollectorBootloader::class,
        Framework\Debug\HttpCollectorBootloader::class,

        RoadRunnerBridge\CommandBootloader::class,

        AnnotatedRoutesBootloader::class,
        Bootloader\APIRoutes::class,
        DebugMiddlewareBootloader::class,
        ValidationMiddlewareBootloader::class,

        // WebSocket
        // https://github.com/roadrunner-server/roadrunner/discussions/1203
        // https://packagist.org/packages/spiral/roadrunner-broadcast
        RoadRunnerBridge\BroadcastingBootloader::class,
    ];

    /*
     * Application specific services and extensions.
     */
    protected const APP = [
//        Bootloader\RoutesBootloader::class,

        // fast code prototyping
//        Prototype\PrototypeBootloader::class,
    ];
}
