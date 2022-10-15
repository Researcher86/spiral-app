<?php

declare(strict_types=1);

namespace App\CQRS\command\User\Create;

use Spiral\Cqrs\CommandInterface;
use Spiral\Filters\Attribute\Input\Data;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Validation\Symfony\AttributesFilter;
use Symfony\Component\Validator\Constraints;

class CreateUserCommand extends AttributesFilter implements CommandInterface
{
    public function __construct(
        #[Post]
//    #[Data]
        #[Constraints\NotBlank]
        #[Constraints\Length(min: 5)]
        public string $name,

        #[Post]
//    #[Data]
        #[Constraints\NotBlank]
        #[Constraints\Positive]
        public int $age
    ) {
    }
}
