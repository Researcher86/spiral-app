<?php

declare(strict_types=1);

namespace App\CQRS\Query\User\GetUserById;

use Spiral\Cqrs\QueryInterface;

class GetUserByIdQuery implements QueryInterface
{
    public function __construct(public readonly string $userId)
    {
    }
}
