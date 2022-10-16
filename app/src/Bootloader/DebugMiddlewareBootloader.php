<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Middleware\ValidationExceptionMiddleware;
use App\Middleware\WhoopsMiddleware;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Bootloader\Http\HttpBootloader;

class DebugMiddlewareBootloader extends Bootloader
{
    public function boot(HttpBootloader $http, EnvironmentInterface $environment): void
    {
        if ($environment->get('DEBUG')) {
            $http->addMiddleware(WhoopsMiddleware::class);
            // Cron таски запускаются в отдельном процессе, /usr/bin/php8.1 app.php schedule:run
            // \defined('SPIRAL_BINARY') ? SPIRAL_BINARY : 'app.php';
            // Для запуска xDebug нужно передать -dxdebug.mode=debug, переменные ENV передаются по умолчанию
            define('SPIRAL_BINARY', '-dxdebug.mode=debug app.php');
            // /usr/bin/php8.1 -dxdebug.mode=debug app.php schedule:run
        }
    }
}
