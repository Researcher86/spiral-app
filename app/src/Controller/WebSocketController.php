<?php

declare(strict_types=1);

namespace App\Controller;

use Spiral\Router\Annotation\Route;

class WebSocketController
{
    #[Route(route: '/ws', methods: 'GET', group: 'ws')]
    public function ws(): array
    {
        return [];
    }
}
