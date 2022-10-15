<?php

declare(strict_types=1);

namespace App\CQRS\Query\User\GetUserById;

use Spiral\Cqrs\Attribute\QueryHandler;

class GetUserByIdQueryHandler
{
    #[QueryHandler]
    public function __invoke(GetUserByIdQuery $query): string
    {
        return $query->userId;
    }
}
