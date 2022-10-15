<?php

namespace App\CQRS\command\User\Event;

class CreatedUserEvent
{
    public function __construct(
        public readonly string $userId
    ) {
    }
}
