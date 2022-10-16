<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Middleware\ValidationExceptionMiddleware;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Bootloader\Http\HttpBootloader;

class ValidationMiddlewareBootloader extends Bootloader
{
    public function boot(HttpBootloader $http, EnvironmentInterface $environment): void
    {
        $http->addMiddleware(ValidationExceptionMiddleware::class);
    }
}
