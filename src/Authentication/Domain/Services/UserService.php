<?php

namespace App\Authentication\Domain\Services;

use App\Authentication\Application\Command\CreateUserCommand;
use App\Authentication\Domain\Services\Contracts\UserService as UserServiceInterface;
use App\Authentication\Domain\User\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements UserServiceInterface
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function buildUser(CreateUserCommand $command): User
    {
        $user = new User(
            $command->getUsername(),
            $command->getPassword(),
            $command->getRole()
        );
        $user->setPassword($this->passwordEncoder->encodePassword($user, $command->getPassword()));

        return $user;
    }
}

