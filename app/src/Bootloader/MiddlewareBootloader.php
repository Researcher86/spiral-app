<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Middleware\ValidationExceptionMiddleware;
use App\Middleware\WhoopsMiddleware;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Http\HttpBootloader;

class MiddlewareBootloader extends Bootloader
{
    public function boot(HttpBootloader $http): void
    {
        $http->addMiddleware(WhoopsMiddleware::class);
        $http->addMiddleware(ValidationExceptionMiddleware::class);
    }
}
