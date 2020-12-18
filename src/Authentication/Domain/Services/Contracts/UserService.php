<?php

namespace App\Authentication\Domain\Services\Contracts;

use App\Authentication\Application\Command\CreateUserCommand;
use App\Authentication\Domain\User\Entity\User;

interface UserService
{
    public function buildUser(CreateUserCommand $command): User;
}
