<?php

namespace App\Authentication\Application\Query;

use App\Authentication\Domain\User\Entity\User;
use App\Authentication\Domain\User\Repository\UserRepository;
use App\Common\Application\CQRS\Query\QueryHandler;

class GetUserByNameHandler implements QueryHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(GetUserByNameQuery $query): ?User
    {
        return $this->userRepository->findOneBy(['username' => $query->username()]);
    }
}
