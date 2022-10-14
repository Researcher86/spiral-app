<?php

declare(strict_types=1);

namespace App\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Router\GroupRegistry;

class APIRoutes extends Bootloader
{
    public function boot(GroupRegistry $groups): void
    {
        $groups->getGroup('api')
            ->setPrefix('/api/v1')
//            ->addMiddleware(SomeMiddleware::class)
        ;
    }
}
