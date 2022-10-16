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
    #[Post]
//    #[Data]
    #[Constraints\NotBlank]
    #[Constraints\Length(min: 5)]
    public string $name;

    #[Post]
//    #[Data]
    #[Constraints\NotBlank]
    #[Constraints\Positive]
    public int $age;

    public static function create(string $name, int $gage): self
    {
        $command = new self();
        $command->name = $name;
        $command->age = $gage;

        return $command;
    }
}
